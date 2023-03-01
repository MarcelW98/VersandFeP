<?php  
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/db_conection.php");



$checkbox = $_POST['checkboxStatus'];

$pdo = DB::getInstance();

$mutation = $pdo->prepare("UPDATE fahrerdaten SET abgeschlossen = ? WHERE id = ?"); 
$mutation->execute(["0", $checkbox ]);

?>