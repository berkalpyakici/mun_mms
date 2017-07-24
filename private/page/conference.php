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

        DB::insert("applications", array(
          "conference" => $_POST["conference"],
          "applicant" => $_SESSION["userid"],
          "time_applied" => microtime(true)
        ));

        echo "ok";
        exit;
        return;
      }
    }
  }
