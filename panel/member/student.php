<? $memberonly = true; ?>
<? include("../include.php"); ?>
<? include(PATH_PRIVATE."page/loader.php"); ?>
<? include(PATH_PRIVATE."page/student.php"); ?>
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
      <? if(IS_ADVISOR) {?>
      <div class="alert alert-warning">
        You are viewing this page as an advisor. Therefore, can change all information on this page.<br>
        <? if(IS_LOCAL_ADVISOR) { ?><a href="#" data-toggle="modal" data-target="#editAdvInf">Edit Advisor Information</a> &middot; <a href="../account/<?= $localid ?>">Edit Account Information</a><? } ?>
        <? if(IS_LOCAL_MEMBER) { ?><a href="#" data-toggle="modal" data-target="#editStuInf">Edit Student Information</a> &middot; <a href="#" data-toggle="modal" data-target="#editPrntInf">Edit Parent Information</a> &middot; <a href="../account/<?= $localid ?>">Edit Account Information</a><? } ?>
      </div>
      <? } ?>

      <? if(IS_MEMBER and IS_LOCAL_MEMBER) {?>
      <div class="alert alert-warning">
        You are viewing your page. Therefore, can change all information on this page.<br>
        <? if(IS_LOCAL_MEMBER) { ?><a href="#" data-toggle="modal" data-target="#editStuInf">Edit Student Information</a> &middot; <a href="#" data-toggle="modal" data-target="#editPrntInf">Edit Parent Information</a> &middot; <a href="../account/<?= $localid ?>">Edit Account Information</a><? } ?>
      </div>
      <? } ?>

      <div class="jumbotron visible-lg visible-md">
        <img src="../uploads/profile/<?= $localmaster["avatar"] ?>" height="92px" width="92px" class="pull-left" style="margin-right: 48px;">
        <h2 style="margin-top: 15px; margin-bottom: 15px;"><?= $localmaster["fullname"] ?></h2>
        <? if(IS_LOCAL_MEMBER) { ?>
        <h4>Class of <?= $localmaster["class"] ?> (<?= gradefromclass($localmaster["class"]); ?>th Grade)</h4>
        <? } ?>
        <? if(IS_LOCAL_ADVISOR) { ?>
        <h4>Office: <?= $localmaster["officenumber"] ?></h4>
        <? } ?>
      </div>

      <div class="jumbotron visible-xs visible-sm text-center">
        <img src="../uploads/profile/<?= $localmaster["avatar"] ?>" height="92px" width="92px">
        <h2><?= $localmaster["fullname"] ?></h2>
        <? if(IS_LOCAL_MEMBER) { ?>
        <h4>Class of <?= $localmaster["class"] ?> (<?= gradefromclass($localmaster["class"]); ?>th Grade)</h4>
        <? } ?>
        <? if(IS_LOCAL_ADVISOR) { ?>
        <h4>Office: <?= $localmaster["officenumber"] ?></h4>
        <? } ?>
      </div>

      <? if(IS_LOCAL_ADVISOR) { ?>
        <h3>Advisor Information</h3>

        <div class="panel panel-default">
          <div class="panel-body">
            <h4>Contact</h4>
            <hr>
            <p>
              <strong>Full Name</strong>
              <br>
              <?= $localmaster["fullname"] ?>
              <? if(empty($localmaster["fullname"])) { echo "N/A"; } ?>
            </p>
            <p>
              <strong>Email Address</strong>
              <br>
              <a href="mailto:<?= $localmaster["email"] ?>"><?= $localmaster["email"] ?></a>
              <? if(empty($localmaster["email"])) { echo "N/A"; } ?>
            </p>
            <p>
              <strong>Mobile Number</strong>
              <br>
              <?= $localmaster["mobile"] ?>
              <? if(empty($localmaster["mobile"])) { echo "N/A"; } ?>
            </p>
            <p>
              <strong>Home Address</strong>
              <br>
              <?= $localmaster["address"] ?>
              <? if(empty($localmaster["address"])) { echo "N/A"; } ?>
            </p>
            <p>
              <strong>Office Number</strong>
              <br>
              <?= $localmaster["officenumber"] ?>
              <? if(empty($localmaster["officenumber"])) { echo "N/A"; } ?>
            </p>

          </div>
        </div>

        <? if(IS_ADVISOR) { ?>
        <form id="formAdvInf" action="student.php" method="post" accept-charset="UTF-8">
        <div class="modal fade" id="editAdvInf" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Advisor Information</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Full name*</label>
                  <input type="text" name="fullname" class="form-control" placeholder="Full name" value="<?= $localmaster["fullname"] ?>">
                </div>
                <div class="form-group">
                  <label>Email address</label>
                  <input type="email" name="email" class="form-control" placeholder="Email address" value="<?= $localmaster["email"] ?>">
                </div>
                <div class="form-group">
                  <label>Mobile number</label>
                  <input type="text" name="mobile" class="form-control" placeholder="Mobile number" value="<?= $localmaster["mobile"] ?>">
                </div>
                <div class="form-group">
                  <label>Home address</label>
                  <input type="text" name="address" class="form-control" placeholder="Home address" value="<?= $localmaster["address"] ?>">
                </div>
                <div class="form-group">
                  <label>Office number</label>
                  <input type="text" name="officenumber" class="form-control" placeholder="Office number" value="<?= $localmaster["officenumber"] ?>">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <input type="hidden" name="userid" value="<?= $localmaster["id"] ?>">
                <input type="hidden" name="type" value="AdvInf">
              </div>
            </div>
          </div>
        </div>
        </form>
        <? } ?>
      <? } ?>

      <? if(IS_LOCAL_MEMBER) { ?>
      <div class="row">
        <div class="col-xs-12 col-md-6">
          <h3>Student Information</h3>

          <div class="panel panel-default">
            <div class="panel-body">
              <h4>Contact</h4>
              <hr>
              <p>
                <strong>Full Name</strong>
                <br>
                <?= $localmaster["fullname"] ?>
                <? if(empty($localmaster["fullname"])) { echo "N/A"; } ?>
              </p>
              <p>
                <strong>Email Address</strong>
                <br>
                <a href="mailto:<?= $localmaster["email"] ?>"><?= $localmaster["email"] ?></a>
                <? if(empty($localmaster["email"])) { echo "N/A"; } ?>
              </p>
              <p>
                <strong>Mobile Number</strong>
                <br>
                <?= $localmaster["mobile"] ?>
                <? if(empty($localmaster["mobile"])) { echo "N/A"; } ?>
              </p>
              <p>
                <strong>Home Address</strong>
                <br>
                <?= $localmaster["address"] ?>
                <? if(empty($localmaster["address"])) { echo "N/A"; } ?>
              </p>

              <br>

              <h4>Academic Performance</h4>
              <hr>
              <p>
                <strong><?= PREVTERM ?> Academic Year GPA </strong>
                <br>
                <?= $localmaster["prev_gpa"] ?>
                <? if(empty($localmaster["prev_gpa"])) { echo "N/A"; } ?>
              </p>
              <p>
                <strong><?= PREVTERM ?> Academic Year English Score</strong>
                <br>
                <?= $localmaster["prev_english"] ?>
                <? if(empty($localmaster["prev_english"])) { echo "N/A"; } ?>
              </p>

            </div>
          </div>
        </div>

        <!-- Modal -->
        <form id="formStuInf" action="student.php" method="post" accept-charset="UTF-8">
        <div class="modal fade" id="editStuInf" tabindex="-1" role="dialog">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel">Edit Student Information</h4>
              </div>
              <div class="modal-body">
                <div class="form-group">
                  <label>Full name*</label>
                  <input type="text" name="student_fullname" class="form-control" placeholder="Full name" value="<?= $localmaster["fullname"] ?>">
                </div>
                <div class="form-group">
                  <label>Email address</label>
                  <input type="email" name="student_email" class="form-control" placeholder="Email address" value="<?= $localmaster["email"] ?>">
                </div>
                <div class="form-group">
                  <label>Mobile number</label>
                  <input type="text" name="student_mobile" class="form-control" placeholder="Mobile number" value="<?= $localmaster["mobile"] ?>">
                </div>
                <div class="form-group">
                  <label>Home address</label>
                  <input type="text" name="student_address" class="form-control" placeholder="Home address" value="<?= $localmaster["address"] ?>">
                </div>

                <hr>

                <div class="form-group">
                  <label><?= PREVTERM ?> Academic Year GPA</label>
                  <input type="text" name="student_gpa" class="form-control" placeholder="GPA" value="<?= $localmaster["prev_gpa"] ?>">
                </div>
                <div class="form-group">
                  <label><?= PREVTERM ?> Academic Year English Score</label>
                  <input type="text" name="student_english" class="form-control" placeholder="English Score" value="<?= $localmaster["prev_english"] ?>">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
                <input type="hidden" name="userid" value="<?= $localmaster["id"] ?>">
                <input type="hidden" name="type" value="StuInf">
              </div>
            </div>
          </div>
        </div>
        </form>

        <div class="col-xs-12 col-md-6">
          <h3>Parent Information</h3>

          <div class="panel panel-default">
            <div class="panel-body">
              <h4>Mother</h4>
              <hr>
              <p>
                <strong>Full Name</strong>
                <br>
                <?= $localmaster["mother_fullname"] ?>
                <? if(empty($localmaster["mother_fullname"])) { echo "N/A"; } ?>
              </p>
              <p>
                <strong>Mobile Number</strong>
                <br>
                <?= $localmaster["mother_mobile"] ?>
                <? if(empty($localmaster["mother_mobile"])) { echo "N/A"; } ?>
              </p>
              <p>
                <strong>Email Address</strong>
                <br>
                <a href="mailto:<?= $localmaster["mother_email"] ?>"><?= $localmaster["mother_email"] ?></a>
                <? if(empty($localmaster["mother_email"])) { echo "N/A"; } ?>
              </p>

              <br>

              <h4>Father</h4>
              <hr>
              <p>
                <strong>Full Name</strong>
                <br>
                <?= $localmaster["father_fullname"] ?>
                <? if(empty($localmaster["father_fullname"])) { echo "N/A"; } ?>
              </p>
              <p>
                <strong>Mobile Number</strong>
                <br>
                <?= $localmaster["father_mobile"] ?>
                <? if(empty($localmaster["father_mobile"])) { echo "N/A"; } ?>
              </p>
              <p>
                <strong>Email Address</strong>
                <br>
                <a href="mailto:<?= $localmaster["father_email"] ?>"><?= $localmaster["father_email"] ?></a>
                <? if(empty($localmaster["father_email"])) { echo "N/A"; } ?>
              </p>
            </div>
          </div>
        </div>
      </div>

      <!-- Modal -->
      <form id="formPrntInf" action="student.php" method="post" accept-charset="UTF-8">
      <div class="modal fade" id="editPrntInf" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title" id="myModalLabel">Edit Parent Information</h4>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label>Mother - Full name</label>
                <input type="text" name="mother_fullname" class="form-control" placeholder="Full name" value="<?= $localmaster["mother_fullname"] ?>">
              </div>
              <div class="form-group">
                <label>Mother - Email address</label>
                <input type="text" name="mother_email" class="form-control" placeholder="Email address" value="<?= $localmaster["mother_email"] ?>">
              </div>
              <div class="form-group">
                <label>Mother - Mobile number</label>
                <input type="text" name="mother_mobile" class="form-control" placeholder="Mobile Number" value="<?= $localmaster["mother_mobile"] ?>">
              </div>

              <hr>

              <div class="form-group">
                <label>Father - Full name</label>
                <input type="text" name="father_fullname" class="form-control" placeholder="Full name" value="<?= $localmaster["father_fullname"] ?>">
              </div>
              <div class="form-group">
                <label>Father - Email address</label>
                <input type="text" name="father_email" class="form-control" placeholder="Email address" value="<?= $localmaster["father_email"] ?>">
              </div>
              <div class="form-group">
                <label>Father - Mobile number</label>
                <input type="text" name="father_mobile" class="form-control" placeholder="Mobile Number" value="<?= $localmaster["father_mobile"] ?>">
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Save Changes</button>
              <input type="hidden" name="userid" value="<?= $localmaster["id"] ?>">
              <input type="hidden" name="type" value="PrntInf">
            </div>
          </div>
        </div>
      </div>
      </form>
      <? } ?>

      <? if(IS_LOCAL_MEMBER) { ?>
      <h3>Previous Conferences</h3>
      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table" style="margin-bottom: 0px;">
            <thead>
              <tr>
                <th>Conference</th>
                <th>Date</th>
                <th>Committee</th>
                <th>Position</th>
                <th>Comments</th>
              </tr>
            </thead>
            <tbody>
              <? foreach($local["attendencies"] as $data) { ?>
              <tr>
                <td><?= $data["name"] ?></td>
                <td><?= date("d.m.Y",$data["date"]) ?></td>
                <td><?= $data["committee"] ?></td>
                <td><?= $data["position"] ?></td>
                <td><?= $data["comments"] ?></td>
              </tr>
              <? } ?>
            </tbody>
          </table>
          <br>
          <div class="alert alert-danger">Conference list will be available soon.</div>
        </div>
      </div>
      <? } ?>

      <? if(IS_ADVISOR and IS_LOCAL_MEMBER) { ?>
      <h3>Misbehaviours</h3>
      <div class="panel panel-default">
        <div class="panel-body">
          <table class="table" style="margin-bottom: 0px;">
            <thead>
              <tr>
                <th>Reason</th>
                <th>Issuer</th>
                <th>Date</th>
              </tr>
            </thead>
            <tbody>
              <? foreach($local["misbehaviours"] as $data) { ?>
              <tr>
                <td><?= $data["reason"] ?></td>
                <td><?= $data["issuer_name"] ?></td>
                <td><?= date("d.m.Y",$data["date"]) ?></td>
              </tr>
              <? } ?>
            </tbody>
          </table>
          <br>
          <div class="alert alert-danger">Misbehaviours list will be available soon.</div>
        </div>
      </div>
      <? } ?>

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
