<?php  
set_time_limit(0);
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/db_conection.php");



$checkbox = $_POST['checkboxAbgeschlossen'];

$pdo = DB::getInstance();

$mutation = $pdo->prepare("UPDATE fahrerdaten SET abgeschlossen = ? WHERE id = ?"); 
$mutation->execute(["checked", $checkbox ]);

timerDelete($checkbox);


function timerDelete($idChechbox){
sleep(120);
    $pdo = DB::getInstance();

    $mutation = $pdo->query("SELECT * FROM fahrerdaten WHERE id = $idChechbox "); 
    $result = $mutation ->fetch(PDO::FETCH_ASSOC);
   

     if ($result['abgeschlossen'] == "checked"){
        $datum = date("d-m-Y H:i:s", time() );
         $mutation1 = $pdo->prepare("INSERT INTO fahrerdatenverlauf(id, fahrername, kennzeichen, spedition, bolognr, sonderfahrt, ankunftszeit, abgeschlossen) VALUES (?, ?, ?, ?, ?, ?, ?, ? )"); 
         $mutation1->execute([null, $result['fahrername'], $result['kennzeichen'], $result['spedition'],  $result['bolognr'], $result['Sonderfahrt'], $result['ankunftszeit'], $datum]);
        

        $mutation2 = $pdo->prepare("DELETE FROM `fahrerdaten` WHERE id = ? "); 
        $mutation2->execute([$idChechbox]);
      }
}


?>