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
$prio = array();


// Abfrage ob Barcode input leer
if(empty($form_data->barcode_scanversand))
{
 $error1["barcode_scanversand"] = "Bitte den Barcode einscannen!";
 $data["error1"] = $error1;
}

// Abfrage ob Auftrag in datenbank vorhanden
if(!empty($form_data->barcode_scanversand))
{
    $barcode_scanversand = mysqli_real_escape_string($dbcon, $form_data->barcode_scanversand);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanversand' "; 
    $res = $dbcon->query($query);
    if($res->num_rows == 0) {
        $error1["barcode_scanversand"] = "Der Auftrag wurde nicht gefunden";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag Priorisiert
if(!empty($form_data->barcode_scanversand))
{
    $barcode_scanversand = mysqli_real_escape_string($dbcon, $form_data->barcode_scanversand);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanversand' AND Prioritaet_Wareneingang = 'eilig' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $prio["barcode_scanversand"] = "<-- Achtung: Der Auftrag ist eilig -->";
        $data["prio"] = $prio;  
    }
}

// Abfrage ob Transportpapiere erstellt
if(!empty($form_data->barcode_scanversand))
{
    $barcode_scanversand = mysqli_real_escape_string($dbcon, $form_data->barcode_scanversand);
    $statetransport= "";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanversand' AND Status_Transportpapiere = '$statetransport' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanversand"] = "Die Transportpapiere wurden noch nicht erstellt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag bereitgestellt
if(!empty($form_data->barcode_scanversand))
{
    $barcode_scanversand = mysqli_real_escape_string($dbcon, $form_data->barcode_scanversand);
    $statebereit = "";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanversand' AND Status_Bereitstellung = '$statebereit' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanversand"] = "Der Auftrag wurde noch nicht bereitgestellt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag verpackt
if(!empty($form_data->barcode_scanversand))
{
    $barcode_scanversand = mysqli_real_escape_string($dbcon, $form_data->barcode_scanversand);
    $statever = "";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanversand' AND Status_Verpacken = '$statever' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanversand"] = "Der Auftrag noch nicht verpackt";
        $data["error1"] = $error1;
    }
}


// Abfrage ob Auftrag versendet
if(!empty($form_data->barcode_scanversand))
{
    $barcode_scanversand = mysqli_real_escape_string($dbcon, $form_data->barcode_scanversand);
    $stateversendung= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanversand' AND Status_Versendung = '$stateversendung' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanversand"] = "Die Ware wurde bereits versendet";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag storniert
if(!empty($form_data->barcode_scanversand))
{
    $barcode_scanversand = mysqli_real_escape_string($dbcon, $form_data->barcode_scanversand);
    $statestorno = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanversand' AND Status_Storno = '$statestorno' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanversand"] = "Der Auftrag wurde Storniert";
        $data["error1"] = $error1;
    }
}

// Abfrage Bearbeiter
if(empty($form_data->input_Versandbearbeiter))
{
 $error2["input_Versandbearbeiter"] = "Bitte VKS Nr. eingeben!";
 $data["error2"] = $error2;
}

if(empty($error1) && empty($error2))
{
 $barcode_scanversand = mysqli_real_escape_string($dbcon, $form_data->barcode_scanversand); 
 $input_Versandbearbeiter = "1"; //mysqli_real_escape_string($dbcon, $form_data->input_Versandbearbeiter);
 $datum = date("d.m.Y");
 $uhrzeit = date("H:i:s");
 $stateversand = "1";
 $stateklaer = "";

 $query = "UPDATE versendungen SET Datum_Versendung ='$datum', Zeit_Versendung  ='$uhrzeit', Bearbeiter_VKS_Versendung ='$input_Versandbearbeiter', Status_Versendung ='$stateversand', Status_Klaerung='$stateklaer' Where referenznr = '$barcode_scanversand'";
 if(mysqli_query($dbcon, $query))
 {
  $data["message"] = " -> Der Auftrag wurde gespeichert <- ";
 }
}
    mysqli_close($dbcon);
    echo json_encode($data);

?>