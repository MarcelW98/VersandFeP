<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/auth/authguard.php");

AuthGuard::getInstance()->protect(UserType::ADMIN, UserType::SCHICHT, UserType::BUERO);

$ansicht = $_POST['matchvalue'];
$_SESSION["secondRole"] = $ansicht;

?>