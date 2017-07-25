<?
$curmonth = date("m");
$curyear = date("Y");

if($curmonth >= 7) {
  define('CURTERM',$curyear."-".($curyear+1));
  define('PREVTERM',($curyear-1)."-".$curyear);
  define('GRADCLASS', $curyear+1);
}
else {
  define('CURTERM',($curyear-1)."-".$curyear);
  define('PREVTERM',($curyear-2)."-".($curyear-1));
  define('GRADCLASS', $curyear);
}
