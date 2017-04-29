<? include("include.php"); ?>
<? include(PATH_PRIVATE."page/loader.php"); ?>
<?
if(!function_exists('hash_equals'))
{
    function hash_equals($str1, $str2)
    {
        if(strlen($str1) != strlen($str2))
        {
            return false;
        }
        else
        {
            $res = $str1 ^ $str2;
            $ret = 0;
            for($i = strlen($res) - 1; $i >= 0; $i--)
            {
                $ret |= ord($res[$i]);
            }
            return !$ret;
        }
    }
}


if($_SERVER['REQUEST_METHOD'] == 'POST')
{
	if($_POST["password"] == "" or $_POST["email"] == "")
	{
		echo "empty";
		die();
	}

	$data = DB::queryFirstRow("SELECT * FROM users WHERE email=%s AND removed = 0", $_POST["email"]);

    if(empty($data["hash"]))
    {
        echo "wrong";
		die();
    }

	if(hash_equals($data["hash"], crypt($_POST["password"], $data["hash"])))
	{
		$_SESSION["userid"] = $data["id"];

		echo "success";
		die();
	}
	else
	{
		echo "wrong";
		die();
	}
}
else
{
	if(!empty($_SESSION["userid"]))
  {
		header("Location: dashboard");
		return;
	}
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="icon" type="image/png" href="<?= URL_MAIN ?>favicon.ico">
<title><?= TITLE ?>: Login</title>

<!-- Bootstrap -->
<link href="css/bootstrap.min.css" rel="stylesheet">
<link href="css/global.css" rel="stylesheet">
<link href="css/custom/pages/login.css" rel="stylesheet">

</head>
<body>
<div class="container">
  <form class="form-signin" id="loginform" action="index.php" method="post">

    <img src="uploads/logo/default.png" class="img-responsive">

    <label class="sr-only" >Email address</label>
    <input type="email" class="form-control" name="email" placeholder="Email address" required autofocus>

    <label class="sr-only">Password</label>
    <input type="password" class="form-control" name="password" placeholder="Password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit">Login</button>

	<br>
	<div class="text-danger" id="loginerror">Please check your username and password and try again.</div>
	<br>
    <p class="small"><?= LOGIN_FOOTER ?></p>
  </form>
</div>

<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-3.1.1.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.js"></script>

<script src="js/jquery.form.min.js"></script>
<script>
	$(document).ready(function() {
		$("#loginerror").hide();

		$('#loginform').ajaxForm(function(data) {

			$("#loginerror").hide();

			if(data != "success")
			{
				$("#loginerror").show(250);
			}
			else
			{
				window.location.reload();
			}
		});
	});
</script>
</body>
</html>
