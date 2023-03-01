<?php
session_set_cookie_params(0, '/paketzentrum/');
session_start();
require_once($_SERVER['DOCUMENT_ROOT'] .  "/VersandFeP" . "/database/user_service.php");

if (!is_null(UserService::getInstance()->getLoggedInUser())) {
    session_destroy();
    header("Location: login.php"); //zurück zur login Seite wenn keine Anmeldung  
}

?>