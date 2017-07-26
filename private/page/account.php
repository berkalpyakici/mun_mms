<?
$localid = $_GET["id"];
$localmaster = DB::queryFirstRow("SELECT * FROM users WHERE id=%s AND removed=0",$localid); // Retrieves user data from DB.

if(empty($localmaster["id"])) {
  $localempty = true; // Sets variable true if no result is found in DB.
}

if(IS_MEMBER and $localid != $session["user"]["id"])
{
  $localempty = true; // If the user type is not advisor and the logged in user is not on their own profile page, then sets variable true. This prevents other members from looking into other's profiles.
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(IS_ADVISOR or $session["user"]["id"] == $_POST["userid"]) // Redundant Check
    {
      if($_POST["type"] == "formPassword")
      {
        if(empty($_POST["password"]) or empty($_POST["password_repeat"]))
        {
          echo "empty"; // Returns 'empty', stating that a required field is left empty.
          exit;
          return;
        }

        if($_POST["password"] != $_POST["password_repeat"])
        {
          echo "notmatching"; // Returns 'notmatching', stating that password and repeat password fields do not match.
          exit;
          return;
        }

        $password = $_POST["password"];

        // Following lines hashes & encrypts the password. The hash, then, is inserted into the database. We do not work with plain password.
      	$cost = 10;
      	$salt = strtr(base64_encode(mcrypt_create_iv(64, MCRYPT_DEV_URANDOM)), '+', '.');
      	$salt = sprintf("$2a$%02d$", $cost) . $salt;
      	$hash = crypt($password, $salt);

        DB::update("users", array(
          "hash" => $hash
        ), "id=%s", $_POST["userid"]);

        echo "ok"; // Returns 'ok', stating that everything went fine.
        exit;
        return;
      }

      if($_POST["type"] == "formTermination")
      {
        if(empty($_POST["checkbox"]))
        {
          echo "empty"; // Returns 'empty', stating that a required field is left empty.
          exit;
          return;
        }

        DB::update("users", array(
          "removed" => 1
        ), "id=%s", $_POST["userid"]);

        echo "ok"; // Returns 'ok', stating that everything went fine.
        exit;
        return;
      }

      if($_POST["type"] == "formAvatar")
      {
         if(isset($_FILES['image'])) // Checks whether an image is uploaded.
         {
            $errors = array();

            // Following lines retrieve image info.
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));

            // Creates an unique filename for image.
            $file_serv = md5(uniqid()).".".$file_ext;

            // Limits to only those file types:
            $extensions = array("jpeg","jpg","png");

            if(in_array($file_ext,$extensions) === false)
            {
               echo "filetype"; // Returns 'filetype', stating that file extension is not supported.
               exit;
               return;
            }

            if($file_size > 500000) {
               echo "filesize"; // Returns 'filesize', stating that file size is bove 500 KB.
               exit;
               return;
            }

             move_uploaded_file($file_tmp,PATH_PUBLIC."/uploads/profile/".$file_serv); // Uploads & Moves to file to the directory we have just created.

             DB::update("users", array(
               "avatar" => $file_serv
             ),"id=%s", $_POST["userid"]);

             echo "ok"; // Returns 'ok', stating that everything went fine.
             exit;
             return;
         }
      }
    }

    exit;
    return;
}
