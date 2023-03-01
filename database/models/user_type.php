<?php
class UserType
{
  const ADMIN = 'admin';
  const SCHICHT = 'schichtfuehrer';
  const BUERO = 'buero';
  const WERKSTATT = 'werkstatt';
  const MONITOR = 'monitor';

  public function getConstants()
  {
    $reflectionClass = new ReflectionClass($this);
    $arrayClass1 = $reflectionClass->getConstants();
    $newArray = array();

    foreach ($arrayClass1 as $key => $value) {
      array_push($newArray, $value);
    }
    return $newArray;
  }
}
?>