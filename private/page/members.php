<?
$localid = $_GET["id"];
$locallist = DB::query("SELECT * FROM users WHERE type='member' AND removed=0");

if(empty($locallist)) {
  $localempty = true;
}
else {

}
