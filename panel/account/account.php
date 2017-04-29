<? $memberonly = true; ?>
<? include("../include.php"); ?>
<? include(PATH_PRIVATE."page/loader.php"); ?>
<? include(PATH_PRIVATE."page/account.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="<?= URL_MAIN ?>favicon.ico">
<title><?= TITLE ?>: <?= $localmaster["fullname"]?></title>

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
        <div class="alert alert-danger">User not found.</div>
      <? } else { ?>

      <!-- Main component for a primary marketing message or call to action -->
      <div class="well">
        <h3 style="margin: 0px;"><?= $localmaster["fullname"] ?>'s Account</h3>
        <hr>


        <form class="form-horizontal" id="formPassword" action="account.php" method="post" accept-charset="UTF-8">
        <fieldset>
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-lg-10">
              <h4>Change Password</h4>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label">Password</label>
            <div class="col-md-10">
              <input type="password" class="form-control" id="password" name="password" placeholder="Password">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label">Password (Repeat)</label>
            <div class="col-md-10">
              <input type="password" class="form-control" id="password_repeat" name="password_repeat" placeholder="Password (Repeat)">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-10">
              <button class="btn btn-success" type="submit">Change Password</button>
            </div>
          </div>
          <input type="hidden" name="userid" value="<?= $localmaster["id"] ?>">
          <input type="hidden" name="type" value="formPassword">
        </fieldset>
        </form>

        <hr>

        <form class="form-horizontal" id="formAvatar" action="account.php" method="post" accept-charset="UTF-8">
        <fieldset>
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-lg-10">
              <h4>Change Profile Picture</h4>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label">Current Profile Picture</label>
            <div class="col-md-10">
              <img src="../uploads/profile/<?= $localmaster["avatar"] ?>" height="92px" width="92px" class="img-thumbnail">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label">New Profile Picture File</label>
            <div class="col-md-10">
              <input type="file" class="form-control" name="image">
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-10">
              <button class="btn btn-success" type="submit">Upload and Change Picture</button> <button class="btn btn-warning" type="button">Use Default Picture</button>
            </div>
          </div>
          <input type="hidden" name="userid" value="<?= $localmaster["id"] ?>">
          <input type="hidden" name="type" value="formAvatar">
        </fieldset>
        </form>


        <? if(IS_ADVISOR) { ?>
        <hr>

        <form class="form-horizontal" id="formTermination" action="account.php" method="post" accept-charset="UTF-8">
        <fieldset>
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-lg-10">
              <h4>Terminate Account</h4>
              <p>You can remove this MUN account from the database by checking the checkbox and clicking the red button.</p>
            </div>
          </div>
          <div class="form-group">
            <label class="col-md-2 control-label"></label>
            <div class="col-md-10">
              <button class="btn btn-danger" type="submit">Terminate this Account</button> <input type="checkbox" name="checkbox" style="margin-left: 16px;"> I approve this action cannot be reverted.
            </div>
          </div>
          <input type="hidden" name="userid" value="<?= $localmaster["id"] ?>">
          <input type="hidden" name="type" value="formTermination">
        </fieldset>
        </form>
        <? } ?>
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
    $('#formPassword').ajaxForm(function(data) {
        if(data == "ok") {
          swal("Request Completed!", "Password has successfully been changed!", "success");
        }
        else if(data == "empty") {
          swal("Something went wrong!", "Please fill the required fields!", "error");
        }
        else if(data == "notmatching") {
          swal("Something went wrong!", "The passwords do not match!", "error");
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });

    $('#formTermination').ajaxForm(function(data) {
        if(data == "ok") {
          swal("Request Completed!", "This account has successfully been deleted.", "success");
        }
        else if(data == "empty") {
          swal("Something went wrong!", "Please approve the action.", "error");
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });

    $('#formAvatar').ajaxForm(function(data) {
        if(data == "ok") {
          swal("Request Completed!", "Profile picture has successfully been updated.", "success");
        }
        else if(data == "empty") {
          swal("Something went wrong!", "Please select a picture to upload.", "error");
        }
        else if(data == "filesize") {
          swal("Something went wrong!", "Picture file should be less than 500 KB.", "error");
        }
        else if(data == "filetype") {
          swal("Something went wrong!", "Picture file can only be in .png, .jpg and .jpeg format.", "error");
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });
});
</script>
</body>
</html>
