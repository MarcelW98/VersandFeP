<?php

require_once('database/user_service.php');
$LoginError  = " ";

function redirect($location)
{
    header("Location: {$location}");
}

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
    
        $userService = UserService::getInstance();
        $logged_in_user = $userService->login();  
      
        redirect('startPage.php');
        
    } catch (Exception $e) {
        $LoginError = "Keine Berechtigung<br><br>Hilfe zur Beantragung von Zugriffsberechtigungen<br><br> <form><a href= 'https://inside-docupedia.bosch.com/confluence/pages/viewpage.action?pageId=2297405999'><input class='btn btn-danger rb-button' type='button' value='Hilfe - Docupedia '></a></form>";

        }

}
?>