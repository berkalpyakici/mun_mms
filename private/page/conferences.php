<?
$localid = $_GET["id"];
$locallist = DB::query("SELECT * FROM conferences WHERE 'time' > %s AND removed=0 ORDER BY 'time' DESC",microtime(true));

if(empty($locallist)) {
  $localempty = true;
}
else {
  foreach($locallist as $id => $data)
  {
    $localapplications = DB::query("SELECT * FROM applications WHERE conference=%s AND removed=0",$data['id']);

    $locallist[$id]["numapplications"] = count($localapplications);

    if($data["independent"])
    {
      $locallist[$id]["independent_text"] = "Independent";
    }
    else {
      $locallist[$id]["independent_text"] = "Dependent";
    }
  }
}
