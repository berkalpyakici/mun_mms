<?
$localid = $_GET["id"];
$locallist = DB::query("SELECT * FROM users WHERE class=%s AND type='member' AND removed=0",$localid); // Retrieves user list.

if(empty($locallist)) {
  $localempty = true; // Sets variable true if no result is found in DB.
}
