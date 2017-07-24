<? $memberonly = true; ?>
<? include("../include.php"); ?>
<? include(PATH_PRIVATE."page/loader.php"); ?>
<? include(PATH_PRIVATE."page/conference.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="<?= URL_MAIN ?>favicon.ico">
<title><?= TITLE ?>: <?= $localmaster["name"]?></title>

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
        <div class="alert alert-danger">Conference not found.</div>
      <? } else { ?>

      <!-- Main component for a primary marketing message or call to action -->

      <? if(IS_ADVISOR) {?>
      <div class="alert alert-warning">
        You are viewing this page as an advisor. Therefore, you will be able to change all information on this page.<br>
        <a href="#" data-toggle="modal" data-target="#editConfInf">Edit Conference Information</a>
      </div>
      <? } ?>

      <? if($localmaster["independent"]) { ?>
      <? if(!IS_ADVISOR) { ?>
      <div class="alert alert-success text-left">
        <? if($usrapplied) { ?>
        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#reviewApp"> Review Application</button>
        You have applied this conference.<br><small>Please review your application to meet admission criteria and deadlines.</small>
        <? } else { ?>
        <form id="applyConf" action="conference.php" method="post" accept-charset="UTF-8">
          <input type="hidden" name="type" value="applyConf" />
          <input type="hidden" name="conference" value="<?= $localid ?>" />
          <button type="submit" id="applyConfButton" class="btn btn-success pull-right">Apply Now</button>
        </form>
        <strong><?= $numapplied ?></strong> member(s) applied this conference.<br><small>Apply to receive recommendation letter from your MUN advisor.</small>
        <? } ?>
      </div>
      <? } ?>

      <div class="alert alert-info text-left">
        Internal Deadlines
        <br><small>Deadline for Internal Application: 23.05.2017</small>
        <br><small>Deadline for Document Signatures: 23.05.2017</small>
        <br><small>Deadline for Recommendation: 23.05.2017</small>
      </div>
      <? } ?>

      <div class="jumbotron">
        <h2 style="margin-top: 15px; margin-bottom: 15px;"><?= $localmaster["name"] ?></h2>
        <h4>Hosted by <?= $localmaster["host"] ?> in <?= $localmaster["city"] ?>, <?= $localmaster["country"] ?></h4>

        <hr>

        <div class="row">
          <div class="col-lg-4 text-center">
            <h4><strong>Date</strong><br><small><?= $localmaster["date"] ?></small></h4>
          </div>

          <div class="col-lg-4 text-center">
            <h4><strong>Duration</strong><br><small><?= $localmaster["duration"] ?> Days</small></h4>
          </div>

          <div class="col-lg-4 text-center">
            <h4><strong>Application Type</strong><br><small><?  if($localmaster["independent"]) { echo "Independent Application"; } else { echo "Depentent Application"; } ?></small></h4>
          </div>
        </div>
      </div>

      <div class="modal fade" id="reviewApp" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title">Review Your Application</h4>
            </div>
            <div class="modal-body">
              <ul class="list-group">
                <li class="list-group-item">
                  <span class="badge"><i class="fa fa-check" aria-hidden="true"></i> Verified</span>
                  Internal Application
                  <br><small>Application Received</small>
                </li>

                <li class="list-group-item">
                  <span class="badge"><i class="fa fa-times" aria-hidden="true"></i> Pending</span>
                  Legal Documents
                  <br><small>Intependent Conference Permission Form is Pending</small>
                  <br><small><a href="">Download the Form</a></small>
                </li>

                <li class="list-group-item">
                  <span class="badge"><i class="fa fa-times" aria-hidden="true"></i> Pending</span>
                  Optional: Recommendation Letter
                  <br><small>If this conference requires a recommendation letter, select an advisor.</small>
                  <br>
                  <select class="form-control">
                    <option>N/A</option>
                    <option>Candan Yavuz</option>
                  </select>
                </li>
              </ul>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">Remove Application</button>
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
          </div>
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

<script>
$(document).ready(function() {
    // bind 'myForm' and provide a simple callback function
    $('#applyConf').ajaxForm(function(data) {
        if(data == "ok") {
          location.reload();
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });
});
</script>
</body>
</html>
