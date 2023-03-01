<?php

class accGroup
{
  const acc_ADMIN = 'CN=idm2bcd_FeP_Logistics_admin_W,OU=SECURITYGROUPS,OU=Ci-idm2bcd,OU=Applications,DC=de,DC=bosch,DC=com';
  const acc_SCHICHT = 'CN=idm2bcd_FeP_Logistics_shiftleader_W,OU=SECURITYGROUPS,OU=Ci-idm2bcd,OU=Applications,DC=de,DC=bosch,DC=com';
  const acc_BUERO = 'CN=idm2bcd_FeP_Logistics_office_W,OU=SECURITYGROUPS,OU=Ci-idm2bcd,OU=Applications,DC=de,DC=bosch,DC=com';
  const acc_WERKSATATT = 'CN=idm2bcd_FeP_Logistics_production_W,OU=SECURITYGROUPS,OU=Ci-idm2bcd,OU=Applications,DC=de,DC=bosch,DC=com';
  const acc_MONITOR = 'CN=idm2bcd_FeP_Logistics_monitor_R,OU=SECURITYGROUPS,OU=Ci-idm2bcd,OU=Applications,DC=de,DC=bosch,DC=com';

//

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