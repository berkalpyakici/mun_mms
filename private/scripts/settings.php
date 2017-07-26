<?
$dbsettings = DB::query("SELECT * FROM settings"); // Retrieves settings from DB.

foreach($dbsettings as $data) {
  $mmssettings[$data["setting"]] = $data["value"]; // Creates a machine readable array listing all settings.
}
