<?php  
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/db_conection.php");

if(!empty($_POST['idbearbeiten'])){
    
  
        $id = $_POST['idbearbeiten']; 
        $kundennummer =  $_POST['Kundenummerbearbeiten'];
        $dienstleister = $_POST['Dienstleisterbearbeiten'];
        $acc_nummer = $_POST['AccNummerbearbeiten'];
        $firma = $_POST['Firmabearbeiten'];
        $straße = $_POST['Straßebearbeiten'];
        $stadt = $_POST['Stadtbearbeiten'];
        $land = $_POST['Landbearbeiten'];
//  Zeitstempel noch einfügen
        $pdo = DB::getInstance();
        $mutation = $pdo->prepare("UPDATE accountnummerdaten SET kundennummer=?, dienstleister=?, acc_nummer=?, firma=?, straße=?, stadt=?, land=?  WHERE id=? "); 
        $mutation->execute([$kundennummer, $dienstleister, $acc_nummer, $firma, $straße, $stadt, $land, $id ]);

    }
  

                
?>