<? $memberonly = true; ?>
<? $advisoronly = true; ?>
<? include("../include.php"); ?>
<? include(PATH_PRIVATE."page/loader.php"); ?>
<? include(PATH_PRIVATE."page/application.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="<?= URL_MAIN ?>favicon.ico">
<title><?= TITLE ?>: Application</title>

<!-- Bootstrap -->
<link href="../css/bootstrap.min.css" rel="stylesheet">
<link href="../css/custom/pages/main.css" rel="stylesheet">
<link rel="stylesheet" href="../css/font-awesome.min.css">
<link rel="stylesheet" href="../css/sweetalert.css">

</head>
<body>
  <div class="container">
  <? include(PATH_PRIVATE."page/navbar.php"); ?>

      <? if($localempty) { ?>
        <div class="alert alert-danger">Application not found.</div>
      <? } else { ?>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="jumbotron">
        <h2 style="margin-top: 15px; margin-bottom: 15px;"><?= $localapplicant["fullname"] ?>'s <?= $localconference['name'] ?> Application</h2>
        <h4 style="margin-bottom: 30px;">Application is received on <?= date("d.m.Y",$localmaster["time_applied"]) ?> at <?= date("H:i:s",$localmaster["time_applied"]) ?> server time.</h4>

        <hr>

        <div class="btn-group" role="group" aria-label="...">
          <a href='../member/<?= $localapplicant['id']?>' class="btn btn-info">View Applicant</a>
          <a href='../conference/<?= $localconference['id']?>' class="btn btn-info">View Conference</a>
        </div>

        <hr>

        <div class="row">
          <div class="col-md-4 col-xs-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Advisor for Recommendation <br><small><? if(empty($localmaster['advisor'])) { echo 'Leave empty if not needed.'; } elseif(!empty($localmaster['advisor_locked'])) { echo 'Assigned by an advisor.'; } else { echo 'Picked by the applicant.'; } ?></small></h3>
              </div>
              <div class="panel-body">
                <? if(empty($localadvisor)) { echo 'N/A'; } else { echo $localadvisor['fullname']; } ?>
              </div>
              <div class="panel-footer">
                <button class='btn btn-sm btn-primary' data-toggle="modal" data-target="#advisorModal">Change Advisor</button>
              </div>
            </div>
          </div>

          <form id="selectAdvisor" action="application.php?id=<?= $localid ?>" method="post" accept-charset="UTF-8">
            <div class="modal fade" id="advisorModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Select an Advisor for Recommendation</h4>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="type" value="selectAdvisor" />
                    <select class="form-control" name="advisor">
                      <option value="0">N/A</option>
                      <? foreach($advisors as $data) { ?>
                      <option value="<?= $data['id'] ?>" <? if($localmaster['advisor'] == $data['id']) { echo 'selected'; }?>><?= $data['fullname'] ?></option>
                      <? } ?>
                    </select>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save & Notify Advisor</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <div class="col-md-4 col-xs-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Recommendation <br><small>Deadline: <? if(!empty($localconference['date_reco'])) { echo $localconference['date_reco']; } else { echo 'No Date Set'; } ?></small></h3>
              </div>
              <div class="panel-body">
                <? if(empty($localmaster['recommendation'])) { echo 'Submission Pending'; } else { echo '<a href="../uploads/recommendations/'.$localmaster['recommendation'].'">Click Here to Download</a>'; } ?>
              </div>
              <div class="panel-footer">
                <button class='btn btn-sm btn-primary' data-toggle="modal" data-target="#recoModal">Upload / Update Recommendation</button>
              </div>
            </div>
          </div>

          <form id="uploadReco" action="application.php?id=<?= $localid ?>" method="post" accept-charset="UTF-8">
            <div class="modal fade" id="recoModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Upload or Change Recommendation</h4>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="type" value="uploadReco" />
                    <input type="file" name="reco">
                    <label>Only .docx format is allowed, maximum 120 KB.</label>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload / Change Recommendation</button>
                  </div>
                </div>
              </div>
            </div>
          </form>

          <div class="col-md-4 col-xs-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Documents <br><small>Deadline: <? if(!empty($localconference['date_docs'])) { echo $localconference['date_docs']; } else { echo 'No Date Set'; } ?></small></h3>
              </div>
              <div class="panel-body">
                <? if(!$localmaster['documents']) { echo 'Not Received'; } else { echo 'Received'; } ?>
              </div>
              <div class="panel-footer">
                <button class='btn btn-sm btn-primary' data-toggle="modal" data-target="#statusModal">Update Status / Mark as Done</button>
              </div>
            </div>
          </div>

          <form id="statusUpdate" action="application.php?id=<?= $localid ?>" method="post" accept-charset="UTF-8">
            <div class="modal fade" id="statusModal" tabindex="-1" role="dialog">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Update Status or Mark as Done</h4>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="type" value="updateStatus" />
                    <input type="checkbox" <? if($localmaster['documents']) { echo 'checked'; }?>> Mark Permission form as Submitted
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Upload / Change Recommendation</button>
                  </div>
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>

      <? } ?>

      <? include(PATH_PRIVATE."page/footer.php"); ?>
  </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="../js/jquery-3.1.1.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="../js/bootstrap.js"></script>

<script src="../js/jquery.form.min.js"></script>
<script src="../js/sweetalert.min.js"></script>
<script src="../js/jquery.maskedinput.min.js"></script>

<script>
$(document).ready(function() {
    // bind 'myForm' and provide a simple callback function

    $('#selectAdvisor').ajaxForm(function(data) {
        if(data == "ok") {
          location.reload();
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });

    $('#statusUpdate').ajaxForm(function(data) {
        if(data == "ok") {
          location.reload();
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });

    $('#uploadReco').ajaxForm(function(data) {
        if(data == "ok") {
          location.reload();
        }
        else if(data == "empty") {
          swal("Something went wrong!", "Please select a file to upload.", "error");
        }
        else if(data == "filesize") {
          swal("Something went wrong!", "The file file should be less than 120 KB.", "error");
        }
        else if(data == "filetype") {
          swal("Something went wrong!", "The file can only be in .docx format.", "error");
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });
});
</script>
</body>
</html>
