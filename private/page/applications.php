<?
$localid = $_GET["id"];
$locallist = DB::query("SELECT * FROM applications WHERE removed=0 ORDER BY 'id' DESC");

if(empty($locallist)) {
  $localempty = true;
}
else {
  foreach($locallist as $id => $data)
  {
    $locallist[$id]["applicant"] = DB::queryFirstRow("SELECT * FROM users WHERE id=%s", $data["applicant"]);
    $locallist[$id]["conference"] = DB::queryFirstRow("SELECT * FROM conferences WHERE id=%s", $data["conference"]);
  }
}
