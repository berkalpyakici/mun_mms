<?
function gradefromclass($class) // This function calculates the grade the student is in from their graduating class.
{
  if(CURTERM == ($class-1)."-".$class)
  {
    return "12";
  }
  elseif(CURTERM == ($class-2)."-".($class-1))
  {
    return "11";
  }
  elseif(CURTERM == ($class-3)."-".($class-2))
  {
    return "10";
  }
  elseif(CURTERM == ($class-4)."-".($class-3))
  {
    return "9";
  }
  elseif(CURTERM == ($class-5)."-".($class-4))
  {
    return "LP - 8";
  }
  else
  {
    return "N/A";
  }
}

function getgradelist() // This class returns the list of classes.
{
  $gradclass["12"] = GRADCLASS;
  $gradclass["11"] = GRADCLASS+1;
  $gradclass["10"] = GRADCLASS+2;
  $gradclass["9"] = GRADCLASS+3;
  $gradclass["LP - 8"] = GRADCLASS+4;

  return $gradclass;
}
