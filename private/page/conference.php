<?
$localid = $_GET["id"];
$localmaster = DB::queryFirstRow("SELECT * FROM conferences WHERE id=%s AND removed=0",$localid);
$localapplications = DB::query("SELECT * FROM applications WHERE conference=%s AND removed=0",$localid);

$advisors = DB::query("SELECT * FROM users WHERE type='advisor'");


if(empty($localmaster["id"])) {
  $localempty = true;
}

$numapplied = count($localapplications);
$usrapplied = false;

foreach($localapplications as $data) {
  if($data["applicant"] == $session["user"]["id"]) {
    $usrapplied = true;
    $usrapplication = $data;
  }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(IS_MEMBER)
    {
      if($_POST["type"] == "applyConf")
      {
        if($mmssettings["maxinapp"] > $numapplied and (strtotime($localmaster['date_app']) > microtime(true) or empty($localmaster['date_app']))) {
          DB::insert("applications", array(
            "conference" => $localid,
            "applicant" => $_SESSION["userid"],
            "time_applied" => microtime(true)
          ));

          if($numapplied + 1 == $mmssettings['maxinapp']) {
            foreach($advisors as $data) {
              if($data['email'] == 'berkalp.y@gmail.com') { // REMOVETHIS
                sendemail('Conference Application Update', 'The conference '.$localmaster['name'].' has received '.$mmssettings['maxinapp'].' applications, and the application form is now closed for other club members. If you wish to change this conference to a dependent one, please do so by logging into your MMS account and visiting the conference\'s settings.', 'The conference '.$localmaster['name'].' has received '.$mmssettings['maxinapp'].' applications', $data['email'], $data['fullname']);
              }
            }
          }
        }

        echo "ok";
        exit;
        return;
      }

      if($_POST["type"] == "selectAdvisor")
      {
        if(!$usrapplication["advisor_locked"]) {
          DB::update("applications", array(
            "advisor" => $_POST["advisor"]
          ), "conference=%s AND applicant=%s AND removed=0", $localid, $_SESSION["userid"]);
        }

        if($usrapplication['advisor'] != $_POST['advisor']) {
          if(!empty($usrapplication['advisor'])) {
            $newadvisor = DB::queryFirstRow("SELECT * FROM users WHERE id=%s AND removed=0",$_POST['advisor']);
            $oldadvisor = DB::queryFirstRow("SELECT * FROM users WHERE id=%s AND removed=0",$usrapplication['advisor']);

            if(!empty($newadvisor)) {
              sendemail('Recommendation Request Update', 'Club member '.$session["user"]['fullname'].' requests a recommendation letter for the conference '.$localmaster['name'].' from you. Sign into your MMS account to get further information.', 'Club member '.$session["user"]['fullname'].' requests a recommendation letter.', $newadvisor['email'], $newadvisor['fullname']);
            }

            if(!empty($oldadvisor)) {
              sendemail('Recommendation Request Update', 'Club member '.$session["user"]['fullname'].' NO LONGER requests a recommendation letter for the conference '.$localmaster['name'].' from you. Sign into your MMS account to get further information.', 'Club member '.$session["user"]['fullname'].' NO LONGER requests a recommendation letter.', $oldadvisor['email'], $oldadvisor['fullname']);
            }

          } else {
            $newadvisor = DB::queryFirstRow("SELECT * FROM users WHERE id=%s AND removed=0",$_POST['advisor']);

            if(!empty($newadvisor)) {
              sendemail('Recommendation Request Update', 'Club member '.$session["user"]['fullname'].' requests a recommendation letter for the conference '.$localmaster['name'].' from you. Sign into your MMS account to get further information.', 'Club member '.$session["user"]['fullname'].' requests a recommendation letter.', $newadvisor['email'], $newadvisor['fullname']);
            }
          }
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
