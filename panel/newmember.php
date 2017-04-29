<? $memberonly = true; ?>
<? $advisoronly = true; ?>
<? include("include.php"); ?>
<? include(PATH_PRIVATE."page/loader.php"); ?>
<? include(PATH_PRIVATE."page/newmember.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="<?= URL_MAIN ?>favicon.ico">
<title><?= TITLE ?>: Add New Member</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom/pages/main.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/sweetalert.css">

</head>
<body>
  <div class="container">
  <? include(PATH_PRIVATE."page/navbar.php"); ?>

    <h3>Add New Member</h3>

    <form id="formNewMem" action="newmember.php" method="post" accept-charset="UTF-8">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="form-group">
          <label>Full name*</label>
          <input type="text" name="fullname" class="form-control" placeholder="Full name">
        </div>
        <div class="form-group">
          <label>Email address*</label>
          <input type="email" name="email" class="form-control" placeholder="Email address">
        </div>
        <div class="form-group">
          <label>Class*</label>
          <select class="form-control" name="class">
            <? foreach(getgradelist() as $id => $data) { ?>
            <option value="<?= $data ?>">Class of <?= $data ?> (<?= $id ?>th Grade)</option>
            <? } ?>
          </select>
        </div>
        <div class="form-group">
          <label>Password*</label>
          <input type="password" name="password" class="form-control" placeholder="Password" value="kocmunclub">
          <span class="help-block">Default value: kocmunclub</span>
        </div>
        <div class="form-group">
          <label>Password (repeat)*</label>
          <input type="password" name="password_repeat" class="form-control" placeholder="Password (repeat)" value="kocmunclub">
          <span class="help-block">Default value: kocmunclub</span>
        </div>

        <button type="submit" class="btn btn-primary">Add a New Member</button>
      </div>
    </div>
    </form>

    <? include(PATH_PRIVATE."page/footer.php"); ?>
  </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.1.1.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>

<script src="js/jquery.form.min.js"></script>
<script src="js/sweetalert.min.js"></script>

<script>
$(document).ready(function() {
    // bind 'myForm' and provide a simple callback function
    $('#formNewMem').ajaxForm(function(data) {
        if(data == "ok") {
          location.reload();
        }
        else if(data == "empty") {
          swal("Something went wrong!", "Please fill the required fields!", "error");
        }
        else if(data == "email") {
          swal("Something went wrong!", "The email address you've provided is already in use.", "error");
        }
        else if(data == "notmatching") {
          swal("Something went wrong!", "Passwords do not match.", "error");
        }
        else {
          swal("Something went wrong!", "Please try again later.", "error");
        }
    });
});
</script>

<script>
$('tooltip[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'bottom',
    html: true
});
</script>
</body>
</html>
