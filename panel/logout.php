<? include("include.php"); ?>
<? include(PATH_PRIVATE."page/loader.php"); ?>
<?
  $_SESSION["userid"] = 0;
  session_destroy();
  header("Location: ".URL_MAIN);
?>
