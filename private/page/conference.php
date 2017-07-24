<?
$localid = $_GET["id"];
$localmaster = DB::queryFirstRow("SELECT * FROM conferences WHERE id=%s AND removed=0",$localid);
$localapplications = DB::query("SELECT * FROM applications WHERE conference=%s AND removed=0",$localid);

if(empty($localmaster["id"])) {
  $localempty = true;
}

$numapplied = count($localapplications);
$usrapplied = false;

foreach($localapplications as $data) {
  if($data["applicant"] == $session["user"]["id"]) {
    $usrapplied = true;
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(IS_MEMBER)
    {
      if($_POST["type"] == "applyConf")
      {
        if($mmssettings["maxinapp"] > $numapplied) {
          DB::insert("applications", array(
            "conference" => $localid,
            "applicant" => $_SESSION["userid"],
            "time_applied" => microtime(true)
          ));
        }

        echo "ok";
        exit;
        return;
      }

      if($_POST["type"] == "removeApp")
      {
        DB::update("applications", array(
          "removed" => 1
        ), "conference=%s AND applicant=%s AND removed=0", $localid, $_SESSION["userid"]);

        echo "ok";
        exit;
        return;
      }
    }
  }
