<?php  
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/db_conection.php");
 

if(!empty($_POST['Kundenummer'])){
$kundennummer =  $_POST['Kundenummer'];
$dienstleister = $_POST['Dienstleister'] ;
$accountNummer = $_POST['AccountNummer'] ;
$firma = $_POST['Firma'] ;
$straße = $_POST['Straße'] ;
$stadt = $_POST['Stadt'] ;
$land = $_POST['Land'] ;

$d1 = NULL;

$pdo = DB::getInstance();
$mutation = $pdo->prepare("INSERT INTO accountnummerdaten(id, kundennummer, dienstleister, acc_nummer, firma, straße, stadt, land, timestamp) VALUES (?, ?, ?, ?, ?, ?, ?, ?, CURRENT_TIMESTAMP )"); 
$mutation->execute([$d1, $kundennummer, $dienstleister, $accountNummer, $firma, $straße, $stadt, $land]);

}
             
?>
