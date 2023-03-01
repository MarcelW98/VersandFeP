<?php
    require_once('models/ldap_user.php');

    class LDAP {
        protected static $instance;
        protected $conn;
        protected function __construct() {
            $user = 'LOO6FE@bosch.com';
            $pass = '22versand21!';
            $ldap_serv = 'ldap://rb-gc-12.de.bosch.com';
            $ldap_port = '3268';
            $lc = ldap_connect($ldap_serv, $ldap_port);
            ldap_set_option($lc, LDAP_OPT_REFERRALS, 0);
            ldap_set_option($lc, LDAP_OPT_PROTOCOL_VERSION, 3);
            $ldapbind = ldap_bind($lc, $user, $pass); // verbindung zum Server wir hergestellt 
            if ($ldapbind == false) {
                throw new \Exception('LDAP username or password wrong.');
            }
            $this->conn = $lc;
        }
        public function getConnection() {// conection Parameter für den Server
            return $this->conn;
        }

        public static function getInstance() {
            if(empty(self::$instance)) {
                self::$instance = new LDAP();
            }
            return self::$instance; 
        }
        
        public function getAttributes() {
            return array( "description", "cn", "givenname", "sn", "mail", "co", "mobile", "company", "displayname", "samaccountname", "telephonenumber", "department", "memberof", "group", "physicaldeliveryofficename", "streetaddress", "postalcode", "l");
        }

        public function getBaseDN() {
            return "dc=de,dc=bosch,dc=com";
        }

        public function getEntriesForUser($NTUser): LDAPUser {
            $result = ldap_search($this->getConnection(), $this->getBaseDN(), "cn=$NTUser", $this->getAttributes()) or die("Error in ldapquery"); //suche über das gesamte Verzeichnis nach dem user
            $info = ldap_get_entries($this->getConnection(), $result); //liefert alle passenden Einträge in einem mehrdimensionalen Array 
           
            if ($info["count"] <= 0) {
                throw new Exception('No user found.');
            } else {
                $samaccountname;
                $description;
                $givenname;
                $sn;
                $group;
                $telephonenumber;
                $department;
                $physicaldeliveryofficename;
                $mail;
                $displayname;
                for ($i = 0; $i < $info["count"]; $i++) {
                    $samaccountname = $info[$i]["samaccountname"][0];
                    $description = empty($info[$i]["description"][0]) ? "" : $info[$i]["description"][0];
                    $givenname = $info[$i]["givenname"][0];
                    $sn = $info[$i]["sn"][0];
                    $group = $info[$i]["memberof"];
                    $telephonenumber = empty($info[$i]["telephonenumber"][0]) ? "" : $info[$i]["telephonenumber"][0];
                    $department = empty($info[$i]["department"][0]) ? "" : $info[$i]["department"][0];
                    $physicaldeliveryofficename = empty($info[$i]["physicaldeliveryofficename"][0]) ? "" : $info[$i]["physicaldeliveryofficename"][0];
                    $mail = empty($info[$i]["mail"][0]) ? "" : $info[$i]["mail"][0];
                    $displayname = $info[$i]["displayname"][0];
                }

                return new LDAPUser($samaccountname, $description, $givenname, $sn, $group, $telephonenumber, $department, $physicaldeliveryofficename, $mail, $displayname);
            }
        }
        
    }
?>