<?
$advisors = DB::query("SELECT * FROM users WHERE type='advisor' AND removed=0"); // Retrieves advisor list.
$members = DB::query("SELECT id FROM users WHERE type='member' AND removed=0"); // Retrieves member list.
$conferences = DB::query("SELECT * FROM conferences WHERE removed=0 ORDER BY id DESC LIMIT 10"); // Retrieves conference list.
