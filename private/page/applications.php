<?
$localid = $_GET["id"];
$locallist = DB::query("SELECT * FROM applications WHERE removed=0 ORDER BY 'id' DESC"); // Retrieves applications from DB.

if(empty($locallist)) {
  $localempty = true; // Sets variable true if no result is found in DB.
}
else {
  foreach($locallist as $id => $data)
  {
    $locallist[$id]["applicant"] = DB::queryFirstRow("SELECT * FROM users WHERE id=%s", $data["applicant"]); // Retrieves applicant info for this application.
    $locallist[$id]["conference"] = DB::queryFirstRow("SELECT * FROM conferences WHERE id=%s", $data["conference"]); // Retrieves conference info for this application.
  }
}
