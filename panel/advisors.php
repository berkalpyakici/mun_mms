<? $memberonly = true; ?>
<? $advisoronly = true; ?>
<? include("include.php"); ?>
<? include(PATH_PRIVATE."page/loader.php"); ?>
<? include(PATH_PRIVATE."page/advisors.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="<?= URL_MAIN ?>favicon.ico">
<title><?= TITLE ?>: Advisors</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom/pages/main.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">

</head>
<body>
  <div class="container">
  <? include(PATH_PRIVATE."page/navbar.php"); ?>

    <h3>Advisors</h3>

    <? if($localempty) { ?>
      <div class="alert alert-danger">There are no advisors.</div>
    <? } else { ?>

    <div class="panel panel-default">
      <div class="panel-body">
        <table class="table" style="margin-bottom: 0px;">
          <thead>
            <tr>
              <th>Advisor</th>
              <th>E-Mail</th>
            </tr>
          </thead>
          <tbody>
            <? foreach($locallist as $data) { ?>
            <tr>
              <td><tooltip data-toggle="tooltip" title='<img src="uploads/profile/<?= $data["avatar"] ?>" height="128" width="128">'><a href="member/<?= $data["id"] ?>"><?= $data["fullname"] ?></a></tooltip></td>
              <td><?= $data["email"] ?></td>
            </tr>
            <? } ?>
          </tbody>
        </table>
      </div>
    </div>

    <? } ?>

    <? include(PATH_PRIVATE."page/footer.php"); ?>
  </div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.1.1.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>

<script src="js/jquery.form.min.js"></script>

<script>
$('tooltip[data-toggle="tooltip"]').tooltip({
    animated: 'fade',
    placement: 'bottom',
    html: true
});
</script>
</body>
</html>
