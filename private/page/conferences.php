<?
$localid = $_GET["id"];
$locallist = DB::query("SELECT * FROM conferences WHERE 'time' > %s AND removed=0 ORDER BY 'time' DESC",microtime(true));

if(empty($locallist)) {
  $localempty = true;
}
else {
  foreach($locallist as $id => $data)
  {
    if($data["independent"])
    {
      $locallist[$id]["independent_text"] = "Independent";
    }
    else {
      $locallist[$id]["independent_text"] = "Dependent";
    }
  }
}
