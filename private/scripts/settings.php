<?
$dbsettings = DB::query("SELECT * FROM settings");

foreach($dbsettings as $data) {
  $mmssettings[$data["setting"]] = $data["value"];
}
