<?php  
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/db_conection.php");


if(!empty($_POST['kennezeichenInput'])){
$kennzeichen =  $_POST['kennezeichenInput'];
$spedition = $_POST['speditionInput'] ;
$fahrername = $_POST['fahrerInput'] ;
$bolognr = $_POST['bologInput'];
if (!empty($_POST['flexCheckChecked'])){
    $sonderfahrt = $_POST['flexCheckChecked'] ;
}else{
    $sonderfahrt = "-";
};
$abgeschlossen = "0";

$d1 = NULL;
$datum = date("d-m-Y H:i:s", time() );

$pdo = DB::getInstance();

//Eintrag in die Datenbank der Täglichen Fahreranmeldung schreiben
$mutation = $pdo->prepare("INSERT INTO fahrerdaten(id, fahrername, kennzeichen, spedition, bolognr, sonderfahrt, ankunftszeit, abgeschlossen) VALUES (?, ?, ?, ?, ?, ?, ?, ?)"); 
$mutation->execute([$d1, $fahrername, $kennzeichen, $spedition,  $bolognr, $sonderfahrt, $datum, $abgeschlossen]);


}
             
?>
