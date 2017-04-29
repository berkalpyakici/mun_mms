<? $memberonly = true; ?>
<? $advisoronly = true; ?>
<? include("include.php"); ?>
<? include(PATH_PRIVATE."page/loader.php"); ?>
<? include(PATH_PRIVATE."page/newconference.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="<?= URL_MAIN ?>favicon.ico">
<title><?= TITLE ?>: Add New Conference</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom/pages/main.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">
<link rel="stylesheet" href="css/sweetalert.css">

</head>
<body>
  <div class="container">
  <? include(PATH_PRIVATE."page/navbar.php"); ?>

    <h3>Add New Conference</h3>

    <form id="formNewConf" action="newconference.php" method="post" accept-charset="UTF-8">
    <div class="panel panel-default">
      <div class="panel-body">
        <div class="form-group">
          <label>Conference Name*</label>
          <input type="text" name="name" class="form-control" placeholder="Conference Name">
        </div>
        <div class="form-group">
          <label>Date*</label>
          <input id="date" type="text" name="date" class="form-control" placeholder="dd.mm.yyyy">
        </div>
        <div class="form-group">
          <label>Host School/Foundation*</label>
          <input type="text" name="host" class="form-control" placeholder="Host Name">
        </div>
        <div class="form-group">
          <label>Days*</label>
          <input type="number" name="days" min="1" max="10" class="form-control" placeholder="Days">
        </div>
        <div class="form-group">
          <label>Country*</label>
          <input type="text" name="country" class="form-control" placeholder="Country">
        </div>
        <div class="form-group">
          <label>City*</label>
          <input type="text" name="city" class="form-control" placeholder="City">
        </div>
        <div class="form-group">
          <label>Application Type*</label>
          <select name="applicationtype" class="form-control">
            <option value="0">Dependent Application</option>
            <option value="1">Indepentent Application</option>
          </select>
        </div>

        <button type="submit" class="btn btn-primary">Add a New Conference</button>
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
<script src="js/jquery.maskedinput.min.js"></script>


<script>
$(document).ready(function() {
    // bind 'myForm' and provide a simple callback function

    jQuery(function($){
       $("#date").mask("99.99.9999",{placeholder:"dd.mm.yyyy"});
    });

    $('#formNewConf').ajaxForm(function(data) {
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
