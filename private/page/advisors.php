<?
$localid = $_GET["id"];
$locallist = DB::query("SELECT * FROM users WHERE type='advisor' AND removed=0"); // Retrieves advisors from DB.

if(empty($locallist)) {
  $localempty = true; // Sets variable true if no result is found in DB.
}
