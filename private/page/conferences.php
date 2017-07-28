<?
$localid = $_GET["id"];
$locallist = DB::query("SELECT * FROM conferences WHERE removed=0 ORDER BY id DESC",microtime(true)); // Retrieves conference list.

if(empty($locallist)) {
  $localempty = true; // Sets variable true if no result is found in DB.
}
else {
  foreach($locallist as $id => $data)
  {
    $localapplications = DB::query("SELECT * FROM applications WHERE conference=%s AND removed=0",$data['id']); // Retrieves conference applications for this conference.

    $locallist[$id]["numapplications"] = count($localapplications); // Stores the number of records (applications).

    if($data["independent"]) // Human readable output.
    {
      $locallist[$id]["independent_text"] = "Independent";
    }
    else {
      $locallist[$id]["independent_text"] = "Dependent";
    }
  }
}
