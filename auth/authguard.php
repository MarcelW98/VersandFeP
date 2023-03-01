<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/auth/authstrategy.php");

class AuthGuard {
  protected $authStrategy;
  protected static $instance;

  protected function __construct() {
      $this->authStrategy = AuthStrategy::getInstance();
  }

  public static function getInstance() {
      if(empty(self::$instance)) {
          self::$instance = new AuthGuard();
      }
      return self::$instance;
  }

  public function protect() {
    $whitelist = func_get_args();
    if (session_status() == PHP_SESSION_NONE) {
      session_set_cookie_params(0, '/versandfep/');
      session_start();
    }
    if (!empty($whitelist) && !$this->authStrategy->canActivate($whitelist)) {
      session_destroy();
       $vari = "Location: "."http://".$_SERVER['HTTP_HOST']."/versandfep"."/logout.php";
      //$vari = "Location: "."http://localhost:81/VersandFeP/logout.php";
      header($vari); 
      
    }
  }
}
?>