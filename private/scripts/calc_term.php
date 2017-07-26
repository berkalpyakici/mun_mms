<?
$curmonth = date("m"); // Retrieves the month.
$curyear = date("Y"); // Retrieves the year.

if($curmonth >= 7) { // If the month is >= 7, the CURTERM is set to the current, else the CURTERM is previous.
  define('CURTERM',$curyear."-".($curyear+1));
  define('PREVTERM',($curyear-1)."-".$curyear);
  define('GRADCLASS', $curyear+1);
}
else {
  define('CURTERM',($curyear-1)."-".$curyear);
  define('PREVTERM',($curyear-2)."-".($curyear-1));
  define('GRADCLASS', $curyear);
}
