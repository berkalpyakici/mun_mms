<?

session_start();

// This is meant for only testing. Use it in an EXTREME precaution.
//$_SESSION["userid"] = 1;

$session["user"] = DB::queryFirstRow("SELECT * FROM users WHERE id=%s",$_SESSION["userid"]);

if(!empty($session["user"]))
{
  if($session["user"]["type"] == "member")
  {
    define("IS_MEMBER", true);
    define("IS_ADVISOR", false);

    if($advisoronly or $nonmemberonly)
    {
      header("Location: ".URL_MAIN);
      exit;
    }
  }
  else
  {
    define("IS_MEMBER", false);
    define("IS_ADVISOR", true);
    if($nonmemberonly)
    {
      header("Location: ".URL_MAIN);
      exit;
    }
  }
}
else {
  if($memberonly)
  {
    header("Location: ".URL_MAIN);
    exit;
  }
}
