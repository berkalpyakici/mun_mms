<?
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(IS_ADVISOR)
    {
      $existingaccount = DB::queryFirstRow("SELECT id FROM users WHERE email=%s", $_POST["email"]);

      if(!empty($existingaccount))
      {
        echo "email";
        exit;
        return;
      }

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

      DB::insert("users", array(
        "email" => $_POST["email"],
        "hash" => $hash,
        "type" => "advisor",
        "fullname" => $_POST["fullname"]
      ));

      echo "ok";
      exit;
      return;
    }
}
