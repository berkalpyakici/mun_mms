<?
$localid = $_GET["id"];
$localmaster = DB::queryFirstRow("SELECT * FROM applications WHERE id=%s AND removed=0",$localid);
$localapplicant = DB::queryFirstRow("SELECT * FROM users WHERE id=%s AND removed=0",$localmaster['applicant']);
$localconference = DB::queryFirstRow("SELECT * FROM conferences WHERE id=%s AND removed=0",$localmaster['conference']);


if(empty($localmaster["id"])) {
  $localempty = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(IS_ADVISOR)
    {
      if($_POST["type"] == "editConf")
      {
        DB::update("conferences", array(
          "name" => $_POST["name"],
          "date" => $_POST["date"],
          "host" => $_POST["host"],
          "duration" => $_POST["days"],
          "country" => $_POST["country"],
          "city" => $_POST["city"],
          "independent" => $_POST["applicationtype"]
        ), 'id=%s', $localid);

        if($localmaster['independent']) {
          DB::update("conferences", array(
            "date_reco" => $_POST["date_reco"],
            "date_app" => $_POST["date_app"],
            "date_docs" => $_POST["date_docs"]
          ), 'id=%s', $localid);
        }

        echo "ok";
        exit;
        return;
      }
    }
  }
