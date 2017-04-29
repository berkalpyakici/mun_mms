<?
$localid = $_GET["id"];
$locallist = DB::query("SELECT * FROM users WHERE class=%s AND type='member' AND removed=0",$localid);

if(empty($locallist)) {
  $localempty = true;
}
else {

}
