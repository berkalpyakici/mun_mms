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
                <h3 class="panel-title">Advisor for Recommendation</h3>
              </div>
              <div class="panel-body">
                N/A
              </div>
              <div class="panel-footer">
                <button class='btn btn-sm btn-primary'>Edit / Update</button>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-xs-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Recommendation</h3>
              </div>
              <div class="panel-body">
                Not Submitted
              </div>
              <div class="panel-footer">
                <button class='btn btn-sm btn-primary'>Edit / Update</button>
              </div>
            </div>
          </div>

          <div class="col-md-4 col-xs-6">
            <div class="panel panel-primary">
              <div class="panel-heading">
                <h3 class="panel-title">Documents</h3>
              </div>
              <div class="panel-body">
                Not Received
              </div>
              <div class="panel-footer">
                <button class='btn btn-sm btn-primary'>Edit / Update</button>
              </div>
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
