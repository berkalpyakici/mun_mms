<? $memberonly = true; ?>
<? include("include.php"); ?>
<? include(PATH_PRIVATE."page/loader.php"); ?>
<? include(PATH_PRIVATE."page/dashboard.php"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?= TITLE ?>: Dashboard</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/custom/pages/main.css" rel="stylesheet">
<link href="css/font-awesome.min.css" rel="stylesheet">

</head>
<body>
  <div class="container">
  <? include(PATH_PRIVATE."page/navbar.php"); ?>

      <!-- Main component for a primary marketing message or call to action -->
      <!--
      <div class="jumbotron">
        <h1>Welcome back!</h1>
        <? if(IS_MEMBER) { ?>
        <p>Welcome to your MMS account. You can update your profile information, apply for a dependent conference and grant permission for an independent conference.<br><br><i>More features will be added.</i></p>
        <? } else { ?>
        <p>Welcome to your MMS account. You can list, edit and add club members, advsiors and conferences, view and review advisor letter requests.<br><br><i>More features will be added.</i></p>
        <? } ?>
      </div>
      -->

      <? if(IS_ADVISOR) { ?>
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <h3>Statistics</h3>

          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row text-center">
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <h3><i class="fa fa-users" aria-hidden="true"></i></h3>
                  <h4>Club Members</h4>
                  <hr>
                  <h3><?= count($members); ?></h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <h3><i class="fa fa-calendar" aria-hidden="true"></i></h3>
                  <h4>Conferences</h4>
                  <hr>
                  <h3><?= count($conferences); ?></h3>
                </div>
                <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                  <h3><i class="fa fa-bell" aria-hidden="true"></i></h3>
                  <h4>Pending Requests</h4>
                  <hr>
                  <h3>0</h3>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-md-6">
          <h3>Quick Access</h3>

          <div class="panel panel-default">
            <div class="panel-body">
              <div class="row text-center">
                <div class="col-sm-6 col-xs-12" style="margin-bottom: 12px;">
                  <a href="newmember" class="btn btn-primary btn-block">
                    <h3 style="margin-top: 0px;"><i class="fa fa-user-plus" aria-hidden="true"></i></h3>
                    Add New Member
                  </a>
                </div>
                <div class="col-sm-6 col-xs-12" style="margin-bottom: 12px;">
                  <a href="newadvisor" class="btn btn-primary btn-block">
                    <h3 style="margin-top: 0px;"><i class="fa fa-user-secret" aria-hidden="true"></i></h3>
                    Add New Advisor
                  </a>
                </div>
                <div class="col-sm-6 col-xs-12">
                  <a href="newconference" class="btn btn-primary btn-block">
                    <h3 style="margin-top: 0px;"><i class="fa fa-calendar-plus-o" aria-hidden="true"></i></h3>
                    Add New Conference
                  </a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <? } ?>

      <div class="row">
        <div class="col-xs-12 col-md-6">
          <h3>Last Added Conferences</h3>

          <div class="panel panel-default">
            <div class="panel-body">
              <table class="table" style="margin-bottom: 0px;">
                <caption>Click on conference's name to view its profile.</caption>
                <thead>
                  <tr>
                    <th>Name</th>
                    <th>Host</th>
                    <th>Date</th>
                  </tr>
                </thead>
                <tbody>
                  <? foreach($conferences as $data) { ?>
                  <tr>
                    <td><a href="conference/<?= $data["id"] ?>"><?= $data["name"] ?></a></td>
                    <td><?= $data["host"] ?></td>
                    <td><?= $data["date"] //date("d.m.Y",$data["date"]) ?></td>
                  </tr>
                  <? } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>

        <div class="col-xs-12 col-md-6">
          <h3>Club Advisors</h3>

          <div class="panel panel-default">
            <div class="panel-body">
              <table class="table" style="margin-bottom: 0px;">
                <caption>Click on advisor's email address to send them an email.</caption>
                <thead>
                  <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                  </tr>
                </thead>
                <tbody>
                  <? foreach($advisors as $data) { ?>
                  <tr>
                    <td><tooltip data-toggle="tooltip" title='<img src="uploads/profile/<?= $data["avatar"] ?>" height="128" width="128">'><a href="member/<?= $data["id"] ?>"><?= $data["fullname"] ?></a></tooltip></td>
                    <td><a href="mailto:<?= $data["email"] ?>"><?= $data["email"] ?></a></td>
                  </tr>
                  <? } ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

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
