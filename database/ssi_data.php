<?php        
        $NTUser = $_SERVER['REMOTE_USER'];
        $attributes_ad = array("displayname","description","cn","givenname","sn","mail","co","mobile","company","displayName","samaccountname","telephonenumber","department","memberof","group","managedobjects");
        $user = 'LOO6FE@bosch.com';
        $pass = '22versand21!';
        //in our system, we already use this account for LDAP authentication on the server above
        $ldap_serv = 'ldap://rb-gc-12.de.bosch.com'; 
        $ldap_port = '3268';
        $baseDN = "dc=de,dc=bosch,dc=com";
        $lc = ldap_connect($ldap_serv, $ldap_port);
        ldap_set_option($lc, LDAP_OPT_REFERRALS, 0);
        ldap_set_option($lc, LDAP_OPT_PROTOCOL_VERSION, 3);
        $ldapbind = ldap_bind($lc,$user,$pass);
        $newTableRow = "";
        $input_NTUser = "";
        $UserNotfound = "";
        $displayName = "";
        
        
        if ($ldapbind == false) {
          echo 'username or password is wrong';
        }
        else{

          if(isset($_POST['absenden']   )){
            $input_NTUser = $_POST['testinput'];
            $result = ldap_search($lc, $baseDN, "cn=$input_NTUser",  $attributes_ad ) or die ("Error in searchquery");
            $info = ldap_get_entries($lc, $result);

            if ($info["count"] <= 0) {
              
              $UserNotfound = "User nicht gefunden";
            
            }else{
           
            $displayName = "für: " .$info[0]["displayname"][0];
           $namesarray=[];
           
           foreach($info[0] as $x => $val){
           if(!is_array($val)){
            array_push($namesarray, $val);
             }
           }
           $t=0;
           $newTableRow .= "<tr><th>Klasse</th><th>Daten</th></tr>";
               foreach($info[0] as $l => $val){
               
                  if(is_array($val)){
                   
                   $newTableRow .= "<tr><td>" . $namesarray[$t] . "</td>";
                  for($lk=0; $lk<(sizeof($val)-1); $lk++){
                    if($lk == 0){
                     $newTableRow .= "<td>" . $info[0][$namesarray[$t]][$lk] . '</td>';
                     
                    }else{
                     $newTableRow .=  "<tr><td></td><td>" . $info[0][$namesarray[$t]][$lk] . '</td></tr>';
                    }
                     }
                     $t++;
                     $newTableRow .= "</tr>";
                 }
             }
            
           }
          }

        }
        
      
?>