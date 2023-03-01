<?php  
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/db_conection.php");

if(!empty($_POST['buttonsenden'])){
  
  
       $data = $_POST['buttonsenden'];  
        $pdo = DB::getInstance();
        $mutation = $pdo->prepare("DELETE FROM `accountnummerdaten` WHERE id = $data "); 
        $mutation->execute([$data]);
    }
    
                
?>
