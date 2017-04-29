<? $memberonly = true; ?>
<? include("include.php"); ?>
<? include(PATH_PRIVATE."page/loader.php"); ?>
<? include(PATH_PRIVATE."page/conferences.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="<?= URL_MAIN ?>favicon.ico">
<title><?= TITLE ?>: Conferences</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom/pages/main.css" rel="stylesheet">
<link rel="stylesheet" href="css/font-awesome.min.css">

</head>
<body>
  <div class="container">
  <? include(PATH_PRIVATE."page/navbar.php"); ?>

    <h3>Conferences</h3>

    <? if($localempty) { ?>
      <div class="alert alert-danger">There are no upcoming conferences.</div>
    <? } else { ?>

    <div class="panel panel-default">
      <div class="panel-body">
        <table class="table" style="margin-bottom: 0px;">
          <thead>
            <tr>
              <th>Conferece</th>
              <th>Host</th>
              <th>Date</th>
              <th>Duration</th>
              <th>Location</th>
              <th>Application</th>
            </tr>
          </thead>
          <tbody>
            <? foreach($locallist as $data) { ?>
            <tr>
              <td><a href="conference/<?= $data["id"] ?>"><?= $data["name"] ?></a></td>
              <td><?= $data["host"] ?></td>
              <td><?= $data["date"] //date("d.m.Y",$data["date"]) ?></td>
              <td><?= $data["duration"] ?> Days</td>
              <td><?= $data["city"] ?>, <?= $data["country"] ?></td>
              <td><?= $data["independent_text"] ?></td>
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
