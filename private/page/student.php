<?
$localid = $_GET["id"];
$localmaster = DB::queryFirstRow("SELECT * FROM users WHERE id=%s AND removed=0",$localid);

if(empty($localmaster["id"])) {
  $localempty = true;
}

if(IS_MEMBER and $localid != $session["user"]["id"] and !IS_LOCAL_ADVISOR)
{
  $localempty = true;
}

if($localmaster["type"] == "advisor")
{
  define("IS_LOCAL_ADVISOR", true);
  define("IS_LOCAL_MEMBER", false);
}

if($localmaster["type"] == "member")
{
  define("IS_LOCAL_ADVISOR", false);
  define("IS_LOCAL_MEMBER", true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(IS_ADVISOR)
    {
      if($_POST["type"] == "AdvInf")
      {
        if(empty($_POST["fullname"]) or empty($_POST["email"]))
        {
          echo "empty";
          exit;
          return;
        }

        $existingaccount = DB::queryFirstRow("SELECT id FROM users WHERE email=%s AND id != %s", $_POST["email"], $_POST["userid"]);

        if(!empty($existingaccount))
        {
          echo "email";
          exit;
          return;
        }

        DB::update("users", array(
          "fullname" => $_POST["fullname"],
          "email" => $_POST["email"],
          "mobile" => $_POST["mobile"],
          "address" => $_POST["address"],
          "officenumber" => $_POST["officenumber"]
        ), "id=%s", $_POST["userid"]);

        echo "ok";
        exit;
        return;
      }
    }

    if(IS_ADVISOR or $session["user"]["id"] == $_POST["userid"])
    {
      if($_POST["type"] == "StuInf")
      {
        if(empty($_POST["student_fullname"]) or empty($_POST["student_email"]))
        {
          echo "empty";
          exit;
          return;
        }

        $existingaccount = DB::queryFirstRow("SELECT id FROM users WHERE email=%s AND id != %s", $_POST["student_email"], $_POST["userid"]);

        if(!empty($existingaccount))
        {
          echo "email";
          exit;
          return;
        }

        DB::update("users", array(
          "fullname" => $_POST["student_fullname"],
          "email" => $_POST["student_email"],
          "mobile" => $_POST["student_mobile"],
          "address" => $_POST["student_address"],
          "prev_gpa" => $_POST["student_gpa"],
          "prev_english" => $_POST["student_english"]
        ), "id=%s", $_POST["userid"]);

        echo "ok";
        exit;
        return;
      }

      if($_POST["type"] == "PrntInf")
      {
        DB::update("users", array(
          "mother_fullname" => $_POST["mother_fullname"],
          "mother_email" => $_POST["mother_email"],
          "mother_mobile" => $_POST["mother_mobile"],
          "father_fullname" => $_POST["father_fullname"],
          "father_email" => $_POST["father_email"],
          "father_mobile" => $_POST["father_mobile"]
        ), "id=%s", $_POST["userid"]);

        echo "ok";
        exit;
        return;
      }
    }

    exit;
    return;
}

else {
  $local["attendencies"] = array(); //DB::query("SELECT * FROM attendencies WHERE member=%s AND removed=0 ORDER BY id DESC",$localid);
  $local["misbehaviours"] = array(); //DB::query("SELECT * FROM misbehaviours WHERE member=%s AND removed=0 ORDER BY id DESC", $localid);
}
