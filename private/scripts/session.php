<?
session_start();

$session["user"] = DB::queryFirstRow("SELECT * FROM users WHERE id=%s",$_SESSION["userid"]); // Retrieves logged in user's data.

if(!empty($session["user"]))
{
  if($session["user"]["type"] == "member")
  {
    define("IS_MEMBER", true);
    define("IS_ADVISOR", false);

    if($advisoronly or $nonmemberonly) // If the user is on advisor only page and not logged in, we redirect the user to main page.
    {
      header("Location: ".URL_MAIN);
      exit;
    }
  }
  else
  {
    define("IS_MEMBER", false);
    define("IS_ADVISOR", true);

    if($nonmemberonly) // If the user is on non-member only page and not logged in, we redirect the user to main page.
    {
      header("Location: ".URL_MAIN);
      exit;
    }
  }
}
else {
  if($memberonly) // If the user is on member only page and not logged in, we redirect the user to login page.
  {
    header("Location: ".URL_MAIN);
    exit;
  }
}
