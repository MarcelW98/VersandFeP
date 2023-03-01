<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/user_service.php");

class AuthStrategy {
  protected $userService;
  protected static $instance;

  protected function __construct() {
      $this->userService = UserService::getInstance();
  }

  public static function getInstance() {
      if(empty(self::$instance)) {
          self::$instance = new AuthStrategy();
      }
      return self::$instance;
  }

  public function canActivate(Array $allowed_user_types): bool {
    $logged_in_user = $this->userService->getLoggedInUser();

    try {
      if (empty($logged_in_user)) {
        throw new Exception('User not logged in.');
      }

      if (!in_array($logged_in_user->getType(), $allowed_user_types)) {
        throw new Exception('User does not match the specified roles.');
      }
      return true;
    } catch (Exception $e) {
      return false;
    }
  }
}
?>