<?
$advisors = DB::query("SELECT * FROM users WHERE type='advisor' AND removed=0");
$members = DB::query("SELECT id FROM users WHERE type='member' AND removed=0");
$conferences = DB::query("SELECT * FROM conferences WHERE 'time' > %s AND removed=0 ORDER BY 'time' DESC LIMIT 10",microtime(true));