<?
if ($_SERVER['REQUEST_METHOD'] === 'POST')
{
    if(IS_ADVISOR) // Limiting these functions to advisors only.
    {
      DB::insert("conferences", array(
        "name" => $_POST["name"],
        "date" => $_POST["date"],
        "host" => $_POST["host"],
        "duration" => $_POST["days"],
        "country" => $_POST["country"],
        "city" => $_POST["city"],
        "independent" => $_POST["applicationtype"]
      ));

      echo "ok"; // Returns 'ok', stating that everything went fine.
      exit;
      return;
    }
}
