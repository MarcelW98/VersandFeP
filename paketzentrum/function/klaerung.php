<?php  
session_start();  
  
if(isset($_SESSION['benutzer'])) {} else

if(isset($_SESSION['buero'])) {} else
    
if(isset($_SESSION['schichtfuehrer'])) {} else 

if(isset($_SESSION['admin'])) {} else 
{
    header("Location: login.php"); //zurück zur login Seite wenn keine Anmeldung  
}  
?>

<?php
//insert.php
include("../database/db_conection.php");
$form_data = json_decode(file_get_contents("php://input"));
$data = array();
$error1 = array();
$error2 = array();
$error3 = array();
$prio = array();


// Abfrage ob Barcode input leer
if(empty($form_data->barcode_scanklaer))
{
 $error1["barcode_scanklaer"] = "Bitte den Barcode einscannen!";
 $data["error1"] = $error1;
}

// Abfrage ob Auftrag in datenbank vorhanden
if(!empty($form_data->barcode_scanklaer))
{
    $barcode_scanklaer = mysqli_real_escape_string($dbcon, $form_data->barcode_scanklaer);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanklaer' "; 
    $res = $dbcon->query($query);
    if($res->num_rows == 0) {
        $error1["barcode_scanklaer"] = "Der Auftrag wurde nicht gefunden";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag Priorisiert
if(!empty($form_data->barcode_scanklaer))
{
    $barcode_scanklaer = mysqli_real_escape_string($dbcon, $form_data->barcode_scanklaer);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanklaer' AND Prioritaet_Wareneingang = 'eilig' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $prio["barcode_scanklaer"] = "<-- Achtung: Der Auftrag ist eilig -->";
        $data["prio"] = $prio;
    }
}

// Abfrage ob Auftrag Priorisiert
if(!empty($form_data->barcode_scanklaer))
{
    $barcode_scanklaer = mysqli_real_escape_string($dbcon, $form_data->barcode_scanklaer);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanklaer' AND Status_Klaerung = '1' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanklaer"] = "Der Auftrag ist bereits in Klärung";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag versendet
if(!empty($form_data->barcode_scanklaer))
{
    $barcode_scanklaer = mysqli_real_escape_string($dbcon, $form_data->barcode_scanklaer);
    $stateversendung= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanklaer' AND Status_Versendung = '$stateversendung' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanklaer"] = "Die Ware wurde bereits versendet";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag storniert
if(!empty($form_data->barcode_scanklaer))
{
    $barcode_scanklaer = mysqli_real_escape_string($dbcon, $form_data->barcode_scanklaer);
    $statestorno = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanklaer' AND Status_Storno = '$statestorno' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanklaer"] = "Der Auftrag wurde bereits Storniert";
        $data["error1"] = $error1;
    }
}

// Abfrage input Grund
if(empty($form_data->input_Grund))
{
 $error2["input_Grund"] = "Bitte den Klärungsgrund angeben!";
 $data["error2"] = $error2;
}

// Abfrage input Bearbeiter
if(empty($form_data->input_Klaerbearbeiter))
{
 $error3["input_Klaerbearbeiter"] = "Bitte VKS Nr. eingeben!";
 $data["error3"] = $error3;
}

if(empty($error1) && empty($error2) && empty($error3))
{
 $barcode_scanklaer = mysqli_real_escape_string($dbcon, $form_data->barcode_scanklaer); 
 $input_Grund = mysqli_real_escape_string($dbcon, $form_data->input_Grund);
 $input_Klaerbearbeiter = "1"; //mysqli_real_escape_string($dbcon, $form_data->input_Klaerbearbeiter);
 $datum = date("d.m.Y");
 $uhrzeit = date("H:i:s");
 $stateklaer = "1";

 $query = "UPDATE versendungen SET Datum_Klaerung='$datum', Zeit_Klaerung='$uhrzeit', Grund_Klaerung='$input_Grund', Bearbeiter_VKS_Klaerung ='$input_Klaerbearbeiter', Status_Klaerung='$stateklaer' Where referenznr = '$barcode_scanklaer'";
 if(mysqli_query($dbcon, $query))
 {
  $data["message"] = "-> Der Auftrag wurde gespeichert <-";
 }
}
    mysqli_close($dbcon);
    echo json_encode($data);

?>