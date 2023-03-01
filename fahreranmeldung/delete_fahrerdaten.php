<?php  
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/db_conection.php");

$deleteInput = $_POST['deleteInput'];

$pdo = DB::getInstance();

$mutation2 = $pdo->prepare("DELETE FROM `fahrerdaten` WHERE id = ? "); 
$mutation2->execute([$deleteInput]);
?>
