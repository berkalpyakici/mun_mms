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
        <a href="#" data-toggle="modal" data-target="#editConf">Edit Conference Information</a>
      </div>
      <? } ?>

      <? if($localmaster["independent"]) { ?>
      <? if(!IS_ADVISOR) { ?>
      <div class="alert alert-success text-left">
        <? if($usrapplied) { ?>
        <button type="button" class="btn btn-success pull-right" data-toggle="modal" data-target="#reviewApp"> Review Application</button>
        You have applied this conference.<br><small>Please review your application to meet admission criteria and deadlines.</small>
        <? } elseif($mmssettings["maxinapp"] > $numapplied) { ?>
        <form id="applyConf" action="conference.php?id=<?= $localid ?>" method="post" accept-charset="UTF-8">
          <input type="hidden" name="type" value="applyConf" />
          <button type="submit" id="applyConfButton" class="btn btn-success pull-right">Apply Now</button>
        </form>
        <strong><?= $numapplied ?>/<?= $mmssettings["maxinapp"] ?></strong> member(s) applied this conference.<br><small>Apply to receive recommendation letter from your MUN advisor.</small>
        <? } else { ?>
        <strong><?= $numapplied ?>/<?= $mmssettings["maxinapp"] ?></strong> member(s) applied this conference.<br><small>You cannot apply to this conference since the maximum number of applicants is reached.</small>
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

      <? if(IS_ADVISOR) { ?>
      <form id="formEditConf" action="conference.php?id=<?= $localmaster["id"] ?>" method="post" accept-charset="UTF-8">
      <div class="modal fade" id="editConf" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Edit Conference Information</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Conference Name*</label>
                <input type="text" name="name" class="form-control" placeholder="Conference Name" value="<?= $localmaster['name'] ?>">
              </div>
              <div class="form-group">
                <label>Date*</label>
                <input id="date" type="text" name="date" class="form-control" placeholder="dd.mm.yyyy" value="<?= $localmaster['date'] ?>">
              </div>
              <div class="form-group">
                <label>Host School/Foundation*</label>
                <input type="text" name="host" class="form-control" placeholder="Host Name" value="<?= $localmaster['host'] ?>">
              </div>
              <div class="form-group">
                <label>Days*</label>
                <input type="number" name="days" min="1" max="10" class="form-control" placeholder="Days" value="<?= $localmaster['duration'] ?>">
              </div>
              <div class="form-group">
                <label>Country*</label>
                <input type="text" name="country" class="form-control" placeholder="Country" value="<?= $localmaster['country'] ?>">
              </div>
              <div class="form-group">
                <label>City*</label>
                <input type="text" name="city" class="form-control" placeholder="City" value="<?= $localmaster['city'] ?>">
              </div>
              <div class="form-group">
                <label>Application Type*</label>
                <select name="applicationtype" class="form-control">
                  <option value="0" <? if(!$localmaster['independent']) { echo 'selected'; } ?>>Dependent Application</option>
                  <option value="1" <? if($localmaster['independent']) { echo 'selected'; } ?>>Indepentent Application</option>
                </select>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Changes</button>
              <input type="hidden" name="type" value="editConf">
            </div>
          </div>
        </div>
      </div>
      </form>
      <? } ?>

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
              <form id="removeApp" action="conference.php?id=<?= $localid ?>" method="post" accept-charset="UTF-8">
                <input type="hidden" name="type" value="removeApp" />
                <button type="submit" class="btn btn-danger">Remove Application</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              </form>
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
<script src="../js/jquery.maskedinput.min.js"></script>

<script>
$(document).ready(function() {
    // bind 'myForm' and provide a simple callback function

    jQuery(function($){
       $("#date").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
    });

    $('#formEditConf').ajaxForm(function(data) {
        if(data == "ok") {
          location.reload();
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });

    $('#applyConf').ajaxForm(function(data) {
        if(data == "ok") {
          location.reload();
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });

    $('#removeApp').ajaxForm(function(data) {
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
