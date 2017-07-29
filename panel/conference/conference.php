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
          <form id="removeApp" action="conference.php?id=<?= $localid ?>" method="post" accept-charset="UTF-8">
            <input type="hidden" name="type" value="removeApp" />
            <button type="submit" class="btn btn-danger pull-right">Remove Application</button>
            You have applied this conference.<br><small>Please review your application to meet admission criteria and deadlines.</small>
          </form>
        <? } elseif($mmssettings["maxinapp"] > $numapplied and (strtotime($localmaster['date_app']) > microtime(true) or empty($localmaster['date_app']))) { ?>
        <form id="applyConf" action="conference.php?id=<?= $localid ?>" method="post" accept-charset="UTF-8">
          <input type="hidden" name="type" value="applyConf" />
          <button type="submit" id="applyConfButton" class="btn btn-success pull-right">Apply Now</button>
        </form>
        <strong><?= $numapplied ?>/<?= $mmssettings["maxinapp"] ?></strong> member(s) applied this conference.<br><small>Apply to receive recommendation letter from your MUN advisor.</small>
        <? } elseif(strtotime($localmaster['date_app']) > microtime(true) or empty($localmaster['date_app'])) { ?>
        <strong><?= $numapplied ?>/<?= $mmssettings["maxinapp"] ?></strong> member(s) applied this conference.<br><small>You cannot apply to this conference since the maximum number of applicants is reached.</small>
        <? } else { ?>
        <strong><?= $numapplied ?>/<?= $mmssettings["maxinapp"] ?></strong> member(s) applied this conference.<br><small>You cannot apply to this conference since the application deadline has passed.</small>
        <? } ?>
      </div>
      <? } ?>
      <? } ?>

      <div class="jumbotron">
        <h2 style="margin-top: 15px; margin-bottom: 15px;"><?= $localmaster["name"] ?></h2>
        <h4>Hosted by <kbd><?= $localmaster["host"] ?></kbd> in <kbd><?= $localmaster["city"] ?>, <?= $localmaster["country"] ?></kbd></h4>

        <hr>

        <div class="row">
          <div class="col-lg-4 text-center">
            <h4><strong>Date</strong><br><small><?= $localmaster["date"] ?></small></h4>
          </div>

          <div class="col-lg-4 text-center">
            <h4><strong>Duration</strong><br><small><?= $localmaster["duration"] ?> Days</small></h4>
          </div>

          <div class="col-lg-4 text-center">
            <h4><strong>Application Type</strong><br><small><?  if($localmaster["independent"]) { echo "Independent Application"; } else { echo "Depentent Application"; } ?> <? if($localmaster['independent']) { echo '('.$numapplied.'/'.$mmssettings["maxinapp"].')'; } ?></small></h4>
          </div>
        </div>

        <hr>

        <? if($localmaster["independent"]) { ?>
        <div class="panel panel-default">
          <!-- Default panel contents -->
          <div class="panel-heading">MMS Application Schedule</div>
          <div class="panel-body">
            This conference is listed as an independent conference, which means delegates wish to attend this conference should apply this conference internally through MMS. If you have not already, click on Apply Conference button on top of the page. Please note that indepentent conference applications are limited to <?= $mmssettings['maxinapp'] ?> applicants.
          </div>

          <!-- List group -->
          <ul class="list-group">
            <li class="list-group-item">Deadline for Application: <? if(!empty($localmaster['date_app'])) { echo $localmaster['date_app']; } else { echo '<span class="text-danger">No Date Set</span>'; } ?></li>
            <li class="list-group-item">Deadline for Document Submission: <? if(!empty($localmaster['date_docs'])) { echo $localmaster['date_docs']; } else { echo '<span class="text-danger">No Date Set</span>'; } ?></li>
            <li class="list-group-item">Deadline for Recommendations: <? if(!empty($localmaster['date_reco'])) { echo $localmaster['date_reco']; } else { echo '<span class="text-danger">No Date Set</span>'; } ?></li>
          </ul>
        </div>
        <? } ?>

        <? if($usrapplied) { ?>
        <div class="panel panel-primary">
          <!-- Default panel contents -->
          <div class="panel-heading">Your Application Status</div>
          <div class="panel-body">
            We have received your application. Please follow the deadlines given above and make sure every item on the list bellow is done.
          </div>

          <ul class="list-group">
            <li class="list-group-item">
              <span class="badge"><i class="fa fa-check" aria-hidden="true"></i> Verified</span>
              Internal Application
              <br><small>Application Received</small>
            </li>

            <li class="list-group-item">
              <? if(empty($usrapplication['documents'])) { ?>
              <span class="badge"><i class="fa fa-times" aria-hidden="true"></i> Pending</span>
              <? } else { ?>
              <span class="badge"><i class="fa fa-check" aria-hidden="true"></i> Verified</span>
              <? } ?>
              Legal Documents
              <br><small>Download the form bellow, fill it, and submit to your MUN advisor.</small>
              <br><small><a href="../uploads/documents/independent_conference_permission.docx">Download the Form</a></small>
            </li>

            <li class="list-group-item">
              <? if(empty($usrapplication['recommendation'])) { ?>
              <span class="badge"><i class="fa fa-times" aria-hidden="true"></i> Pending</span>
              <? } else { ?>
              <span class="badge"><i class="fa fa-check" aria-hidden="true"></i> Verified</span>
              <? } ?>
              Optional: Recommendation Letter
              <br><small>If this conference requires a recommendation letter, select an advisor.</small>
              <? if(!empty($usrapplication['recommendation'])) { ?>
              <br><small><a href="../uploads/recommendations/<?= $usrapplication['recommendation'] ?>">Click Here to Download</a></small>
              <? } ?>
              <br><br>
              <form id="selectAdvisor" class="row" action="conference.php?id=<?= $localid ?>" method="post" accept-charset="UTF-8">
                <input type="hidden" name="type" value="selectAdvisor" />
                <div class="form-group col-sm-10">
                  <select class="form-control" name="advisor" <? if($usrapplication["advisor_locked"]) { echo 'disabled'; }?>>
                    <option value="0">N/A <? if($usrapplication["advisor_locked"]) { ?>(You cannot change your advisor because this setting has been altered by an advisor.)<? } ?></option>
                    <? foreach($advisors as $data) { ?>
                    <option value="<?= $data['id'] ?>" <? if($usrapplication['advisor'] == $data['id']) { echo 'selected'; }?>><?= $data['fullname'] ?> <? if($usrapplication["advisor_locked"]) { ?>(You cannot change your advisor because this setting has been altered by an advisor.)<? } ?></option>
                    <? } ?>
                  </select>
                </div>
                <div class="form-group col-sm-2 text-right">
                  <button type="submit" class="btn btn-primary" <? if($usrapplication["advisor_locked"]) { echo 'disabled'; }?>>Save & Notify Adv.</button>
                </div>
              </form>
            </li>
          </ul>
        </div>
        <? } ?>
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

              <? if($localmaster['independent']) { ?>
              <hr>

              <div class="form-group">
                <label>Application Deadline</label>
                <small>Leave empty if there is no deadline.</small>
                <input id="date2" type="text" name="date_app" class="form-control" placeholder="dd.mm.yyyy" value="<?= $localmaster['date_app'] ?>">
              </div>
              <div class="form-group">
                <label>Document Submission Deadline</label>
                <small>Leave empty if not required.</small>
                <input id="date3" type="text" name="date_docs" class="form-control" placeholder="dd.mm.yyyy" value="<?= $localmaster['date_docs'] ?>">
              </div>
              <div class="form-group">
                <label>Recommendation Deadline*</label>
                <small>Leave empty if not required.</small>
                <input id="date4" type="text" name="date_reco" class="form-control" placeholder="dd.mm.yyyy" value="<?= $localmaster['date_reco'] ?>">
              </div>

              <? } ?>
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
      $("#date2").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
      $("#date3").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
      $("#date4").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
    });

    $('#formEditConf').ajaxForm(function(data) {
        if(data == "ok") {
          location.reload();
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });

    $('#selectAdvisor').ajaxForm(function(data) {
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
          swal("Something went wrong!", "Please try again later. Error: "+data, "error");
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
