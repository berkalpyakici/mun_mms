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
    $('#formStuInf').ajaxForm(function(data) {
        if(data == "ok") {
          location.reload();
        }
        else if(data == "empty") {
          swal("Something went wrong!", "Please fill the required fields!", "error");
        }
        else if(data == "email") {
          swal("Something went wrong!", "The email address you've provided is already in use.", "error");
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });

    $('#formPrntInf').ajaxForm(function(data) {
        if(data == "ok") {
          location.reload();
        }
        else if(data == "empty") {
          swal("Something went wrong!", "Please fill the required fields!", "error");
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });

    $('#formAdvInf').ajaxForm(function(data) {
        if(data == "ok") {
          location.reload();
        }
        else if(data == "empty") {
          swal("Something went wrong!", "Please fill the required fields!", "error");
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });
});
</script>
</body>
</html>
