<?
$localid = $_GET["id"];
$localmaster = DB::queryFirstRow("SELECT * FROM applications WHERE id=%s AND removed=0",$localid);
$localapplicant = DB::queryFirstRow("SELECT * FROM users WHERE id=%s AND removed=0",$localmaster['applicant']);
$localconference = DB::queryFirstRow("SELECT * FROM conferences WHERE id=%s AND removed=0",$localmaster['conference']);
$localadvisor = DB::queryFirstRow("SELECT * FROM users WHERE id=%s AND removed=0",$localmaster['advisor']);

$advisors = DB::query("SELECT * FROM users WHERE type='advisor'");


if(empty($localmaster["id"])) {
  $localempty = true;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(IS_ADVISOR)
    {
      if($_POST["type"] == "selectAdvisor")
      {
        DB::update("applications", array(
          "advisor" => $_POST["advisor"],
          "advisor_locked" => 1
        ), "conference=%s AND applicant=%s AND removed=0", $localconference["id"], $localapplicant["id"]);

        if($localmaster['advisor'] != $_POST['advisor']) {
          if(!empty($localmaster['advisor'])) {
            $newadvisor = DB::queryFirstRow("SELECT * FROM users WHERE id=%s AND removed=0",$_POST['advisor']);
            $oldadvisor = DB::queryFirstRow("SELECT * FROM users WHERE id=%s AND removed=0",$localmaster['advisor']);

            if(!empty($newadvisor)) {
              sendemail('Recommendation Request Update', 'Club member '.$localapplicant['fullname'].' requests a recommendation letter for the conference '.$localconference['name'].' from you. Sign into your MMS account to get further information.', 'Club member '.$localapplicant['fullname'].' requests a recommendation letter.', $newadvisor['email'], $newadvisor['fullname']);
            }

            if(!empty($oldadvisor)) {
              sendemail('Recommendation Request Update', 'Club member '.$localapplicant['fullname'].' NO LONGER requests a recommendation letter for the conference '.$localconference['name'].' from you. Sign into your MMS account to get further information.', 'Club member '.$localapplicant['fullname'].' NO LONGER requests a recommendation letter.', $oldadvisor['email'], $oldadvisor['fullname']);
            }

          } else {
            $newadvisor = DB::queryFirstRow("SELECT * FROM users WHERE id=%s AND removed=0",$_POST['advisor']);

            if(!empty($newadvisor)) {
              sendemail('Recommendation Request Update', 'Club member '.$localapplicant['fullname'].' requests a recommendation letter for the conference '.$localconference['name'].' from you. Sign into your MMS account to get further information.', 'Club member '.$localapplicant['fullname'].' requests a recommendation letter.', $newadvisor['email'], $newadvisor['fullname']);
            }
          }
        }

        echo "ok";
        exit;
        return;
      }

      if($_POST["type"] == "updateStatus")
      {
        DB::update("applications", array(
          "documents" => 1,
          "time_docs" => microtime(true)
        ), "conference=%s AND applicant=%s AND removed=0", $localconference["id"], $localapplicant["id"]);

        echo "ok";
        exit;
        return;
      }

      if($_POST["type"] == "uploadReco")
      {
         if(isset($_FILES['reco'])) // Checks whether an image is uploaded.
         {
            $errors = array();

            // Following lines retrieve image info.
            $file_name = $_FILES['reco']['name'];
            $file_size = $_FILES['reco']['size'];
            $file_tmp = $_FILES['reco']['tmp_name'];
            $file_type = $_FILES['reco']['type'];
            $file_ext = strtolower(end(explode('.',$_FILES['reco']['name'])));

            // Creates an unique filename for image.
            $file_serv = md5(uniqid()).".".$file_ext;

            // Limits to only those file types:
            $extensions = array("docx");

            if(in_array($file_ext,$extensions) === false)
            {
               echo "filetype"; // Returns 'filetype', stating that file extension is not supported.
               exit;
               return;
            }

            if($file_size > 120000) {
               echo "filesize"; // Returns 'filesize', stating that file size is bove 120 KB.
               exit;
               return;
            }

             move_uploaded_file($file_tmp,PATH_PUBLIC."/uploads/recommendations/".$file_serv); // Uploads & Moves to file to the directory we have just created.

             DB::update("applications", array(
               "recommendation" => $file_serv,
               "time_reco" => microtime(true),
               "Recommendation_submitter" => $_SESSION['userid']
             ), "conference=%s AND applicant=%s AND removed=0", $localconference["id"], $localapplicant["id"]);

             echo "ok"; // Returns 'ok', stating that everything went fine.
             exit;
             return;
         }
      }
    }
  }
