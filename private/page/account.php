<?
$localid = $_GET["id"];
$localmaster = DB::queryFirstRow("SELECT * FROM users WHERE id=%s AND removed=0",$localid);

if(empty($localmaster["id"])) {
  $localempty = true;
}

if(IS_MEMBER and $localid != $session["user"]["id"])
{
  $localempty = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(IS_ADVISOR or $session["user"]["id"] == $_POST["userid"])
    {
      if($_POST["type"] == "formPassword")
      {
        if(empty($_POST["password"]) or empty($_POST["password_repeat"]))
        {
          echo "empty";
          exit;
          return;
        }

        if($_POST["password"] != $_POST["password_repeat"])
        {
          echo "notmatching";
          exit;
          return;
        }

        $password = $_POST["password"];
      	$cost = 10;
      	$salt = strtr(base64_encode(mcrypt_create_iv(64, MCRYPT_DEV_URANDOM)), '+', '.');
      	$salt = sprintf("$2a$%02d$", $cost) . $salt;
      	$hash = crypt($password, $salt);

        DB::update("users", array(
          "hash" => $hash
        ), "id=%s", $_POST["userid"]);

        echo "ok";
        exit;
        return;
      }

      if($_POST["type"] == "formTermination")
      {
        if(empty($_POST["checkbox"]))
        {
          echo "empty";
          exit;
          return;
        }

        DB::update("users", array(
          "removed" => 1
        ), "id=%s", $_POST["userid"]);

        echo "ok";
        exit;
        return;
      }

      if($_POST["type"] == "formAvatar")
      {
         if(isset($_FILES['image']))
         {
            $errors = array();
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_tmp = $_FILES['image']['tmp_name'];
            $file_type = $_FILES['image']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['image']['name'])));

            $file_serv = md5(uniqid()).".".$file_ext;

            $extensions = array("jpeg","jpg","png");

            if(in_array($file_ext,$extensions) === false)
            {
               echo "filetype";
               exit;
               return;
            }

            if($file_size > 500000) {
               echo "filesize"; // 500 KB
               exit;
               return;
            }

             move_uploaded_file($file_tmp,PATH_PUBLIC."/uploads/profile/".$file_serv);

             DB::update("users", array(
               "avatar" => $file_serv
             ),"id=%s", $_POST["userid"]);

             echo "ok";
             exit;
             return;
         }
      }
    }

    exit;
    return;
}
