<?php
require_once('ldap_connection.php');
require_once('paketzenrumuser.php');
require_once('models/user_type.php');
require_once('models/acc_group.php');
require_once('db_conection.php');
require_once('helper.php');

  
class UserService {
    protected $pdo;
    protected static $instance;

    protected function __construct() {
        $this->pdo = DB::getInstance();
    }

    public static function getInstance() {
        if(empty(self::$instance)) {
            self::$instance = new UserService();
        }
        return self::$instance;
    }

    

    public function login() {

        $RealNTUser = "";
        //$RealNTUser = "kda3fe"; //$_SERVER['REMOTE_USER'];
        $RealNTUser = $_SERVER['REMOTE_USER'];
        $ldap_user = LDAP::getInstance()->getEntriesForUser($RealNTUser);
        $ldap_group = $ldap_user->getGroup();
        $roleclass = new accGroup();
        $userclass = new UserType();
        $arrayroleName = $userclass->getConstants();
        $arrayClass = $roleclass->getConstants();
        $right_group = 0;
        $role = "";






for($t = 0; $t < count($arrayClass); $t++){

    if(in_array($arrayClass[$t], $ldap_group)){

        $right_group = $t+1;
        $role = $arrayroleName[$t]; 
        break;
    }
    
}
         try{

        if(empty($right_group)){
                throw new Exception("User not found");
            }
             
                $logged_in_user = new PaketzentrumUser("1", $ldap_user->getVorname() . " " .$ldap_user->getNachname(), $role);
                $_SESSION['ldap_user'] = $ldap_user;
                $_SESSION['user_role'] = $role;
                if (!isset($_SESSION['secondRole'])) {
                    $_SESSION["secondRole"] = 'wählen';
                }
                $_SESSION['logged_in_user'] = $logged_in_user;
                $_SESSION['last_time'] = time();
                return $logged_in_user;
            } catch (Exception $e) {
                throw new Exception('Wrong username or password.');
            }
            

    }
 
    
    public function getLoggedInUser()
    {
        return  !empty($_SESSION['logged_in_user']) ? $_SESSION['logged_in_user'] : null;
    }
}
?>