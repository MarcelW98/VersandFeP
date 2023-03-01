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
$connect = mysqli_connect('127.0.0.1', "root", "", "paketzentrum");
$form_data = json_decode(file_get_contents("php://input"));
$data = array();
$error1 = array();
$error2 = array();
$error3 = array();
$error4 = array();
$prio = array();

// Abfrage ob Barcode input leer
if(empty($form_data->barcode_scantrans))
{
 $error1["barcode_scantrans"] = "Bitte den Barcode einscannen!";
 $data["error1"] = $error1;
}

// Abfrage ob Auftrag in datenbank vorhanden
if(!empty($form_data->barcode_scantrans))
{
    $barcode_scantrans = mysqli_real_escape_string($connect, $form_data->barcode_scantrans);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scantrans' "; 
    $res = $connect->query($query);
    if($res->num_rows == 0) {
        $error1["barcode_scantrans"] = "Der Auftrag wurde nicht gefunden";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag Priorisiert
if(!empty($form_data->barcode_scantrans))
{
    $barcode_scantrans = mysqli_real_escape_string($connect, $form_data->barcode_scantrans);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scantrans' AND Prioritaet_Wareneingang = 'eilig' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $prio["barcode_scantrans"] = "<-- Achtung: Der Auftrag ist eilig -->";
        $data["prio"] = $prio;   
    }
}

// Abfrage ob Auftrag bereitgestellt
if(!empty($form_data->barcode_scantrans))
{
    $barcode_scantrans = mysqli_real_escape_string($connect, $form_data->barcode_scantrans);
    $statebereit = "";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scantrans' AND Status_Bereitstellung = '$statebereit' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scantrans"] = "Der Auftrag wurde noch nicht bereitgestellt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag verpackt
if(!empty($form_data->barcode_scantrans))
{
    $barcode_scantrans = mysqli_real_escape_string($connect, $form_data->barcode_scantrans);
    $statever = "";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scantrans' AND Status_Verpacken = '$statever' "; 
    $res = $connect->query($query);
    if($res->num_rows > 0) {
        $error1["barcode_scantrans"] = "Der Auftrag wurde noch nicht verpackt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Transportpapiere erstellt
if(!empty($form_data->barcode_scantrans))
{
    $barcode_scantrans = mysqli_real_escape_string($connect, $form_data->barcode_scantrans);
    $statetransport= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scantrans' AND Status_Transportpapiere = '$statetransport' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scantrans"] = "Die Transportpapiere wurden schon erstellt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag versendet
if(!empty($form_data->barcode_scantrans))
{
    $barcode_scantrans = mysqli_real_escape_string($connect, $form_data->barcode_scantrans);
    $stateversendung= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scantrans' AND Status_Versendung = '$stateversendung' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scantrans"] = "Die Ware wurde bereits versendet";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag storniert
if(!empty($form_data->barcode_scantrans))
{
    $barcode_scantrans = mysqli_real_escape_string($connect, $form_data->barcode_scantrans);
    $statestorno = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scantrans' AND Status_Storno = '$statestorno' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scantrans"] = "Der Auftrag wurde Storniert";
        $data["error1"] = $error1;
    }
}

// Abfrage input Dienstleister
if(empty($form_data->input_Dienstleister))
{
 $error2["input_Dienstleister"] = "Bitte Dienstleister einscannen";
 $data["error2"] = $error2;
}


// Abfrage input Tracking TNT
if(!empty($form_data->input_Dienstleister))
{
    if(empty($form_data->input_Tracking)) {
    if($form_data->input_Dienstleister == "TNT") {
    $error3["input_Tracking"] = "Bitte die Tracking Nr. von TNT scannen";
    $data["error3"] = $error3;
    }
}
}

// Abfrage input Tracking UPS
if(!empty($form_data->input_Dienstleister))
{
    if(empty($form_data->input_Tracking)) {
    if($form_data->input_Dienstleister == "UPS") {
    $error3["input_Tracking"] = "Bitte die Tracking Nr. von UPS scannen";
    $data["error3"] = $error3;
    }
}
}

// Abfrage input Tracking DHL Express
if(!empty($form_data->input_Dienstleister))
{
    if(empty($form_data->input_Tracking)) {
    if($form_data->input_Dienstleister == "DHL Express") {
    $error3["input_Tracking"] = "Bitte die Tracking Nr. von DHL Express scannen";
    $data["error3"] = $error3;
    }
}
}

// Abfrage input Bearbeiter
if(empty($form_data->input_transbearbeiter))
{
 $error4["input_transbearbeiter"] = "Bitte VKS Nr. eingeben!";
 $data["error4"] = $error4;
}

if(empty($error1) && empty($error2) && empty($error3) && empty($error4))
{
 $barcode_scantrans = mysqli_real_escape_string($connect, $form_data->barcode_scantrans); 
 $input_Dienstleister = mysqli_real_escape_string($connect, $form_data->input_Dienstleister);
 if(empty($form_data->input_Tracking)){
    $input_Tracking ="";  
 }
 if(!empty($form_data->input_Tracking)){
    $input_Tracking = mysqli_real_escape_string($connect, $form_data->input_Tracking); 
 }
 $input_Transbearbeiter = mysqli_real_escape_string($connect, $form_data->input_transbearbeiter);
 $datum = date("d.m.Y");
 $uhrzeit = date("H:i:s");
 $statetrans = "1";
 $stateklaer = "";

 $query = "UPDATE versendungen SET Datum_Transportpapiere='$datum', Zeit_Transportpapiere='$uhrzeit', Paketdienstleister='$input_Dienstleister', Trackingnummer='$input_Tracking', Bearbeiter_VKS_Transportpapiere='$input_Transbearbeiter', Status_Transportpapiere='$statetrans', Status_Klaerung='$stateklaer' Where referenznr = '$barcode_scantrans'";
 if(mysqli_query($connect, $query))
 {
  $data["message"] = "-> Der Auftrag wurde gespeichert <-";
 }
}

echo json_encode($data);

?>