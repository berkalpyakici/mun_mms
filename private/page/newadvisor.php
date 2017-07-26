<?
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(IS_ADVISOR) // Limiting these functions to advisors only.
    {
      $existingaccount = DB::queryFirstRow("SELECT id FROM users WHERE email=%s", $_POST["email"]); // Checking for existing accounts under same email address.

      if(!empty($existingaccount))
      {
        echo "email"; // Returns 'email', stating that email is already in use.
        exit;
        return;
      }

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

      DB::insert("users", array(
        "email" => $_POST["email"],
        "hash" => $hash,
        "type" => "advisor",
        "fullname" => $_POST["fullname"]
      ));

      echo "ok"; // Returns 'ok', stating that everything went fine.
      exit;
      return;
    }
}
