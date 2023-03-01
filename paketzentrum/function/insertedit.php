<?php  
session_start();  
    
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
$error4 = array();
$error5 = array();

// Abfrage ob Barcode input leer
if(empty($form_data->barcode_scan))
{
 $error1["barcode_scan"] = "Bitte den Barcode einscannen!";
 $data["error1"] = $error1;
}
// Abfrage ob Datensatz schon in Datenbank
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($dbcon, $form_data->barcode_scan);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan'"; 
    $res = $dbcon->query($query);
    if($res->num_rows == 0) {
        $error1["barcode_scan"] = "Der Auftrag wurde nicht gefunden";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag versendet
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($dbcon, $form_data->barcode_scan);
    $stateversendung= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan' AND Status_Versendung = '$stateversendung' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scan"] = "Die Ware wurde bereits versendet";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag storniert
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($dbcon, $form_data->barcode_scan);
    $statestorno = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan' AND Status_Storno = '$statestorno' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scan"] = "Der Auftrag wurde Storniert";
        $data["error1"] = $error1;
    }
}

// Abfrage input Auftragsart
if(empty($form_data->input_Auftragsart))
{
 $error2["input_Auftragsart"] = "Auftragsart wird benötigt!";
 $data["error2"] = $error2;
}

// Abfrage input Geschäftsbereich
if(empty($form_data->input_GB))
{
 $error3["input_GB"] = "Geschäftsbereich wird benötigt!";
 $data["error3"] = $error3;
}

// Abfrage input Priorität
if(empty($form_data->input_Prio))
{
 $error4["input_Prio"] = "Priorität wird benötigt!";
 $data["error4"] = $error4;
}

// Abfrage input Hinweis
if(empty($form_data->input_Hinweis))
{
 $error5["input_Hinweis"] = "Hinweis wird benötigt!";
 $data["error5"] = $error5;
}

if(empty($error1) && empty($error2) && empty($error3) && empty($error4) && empty($error5))
{ 
 $barcode_scan = mysqli_real_escape_string($dbcon, $form_data->barcode_scan); 
 $input_Auftragsart = mysqli_real_escape_string($dbcon, $form_data->input_Auftragsart);
 $input_GB = mysqli_real_escape_string($dbcon, $form_data->input_GB);
 $input_Prio = mysqli_real_escape_string($dbcon, $form_data->input_Prio);
 $input_Hinweis = mysqli_real_escape_string($dbcon, $form_data->input_Hinweis);
 

 $query = "UPDATE versendungen SET Auftragsart_Wareneingang='$input_Auftragsart', GB_Wareneingang='$input_GB', Prioritaet_Wareneingang='$input_Prio', Hinweis_Wareneingang='$input_Hinweis' Where referenznr='$barcode_scan'";
 if(mysqli_query($dbcon, $query))
 {
  $data["message"] = "-> Der Auftrag wurde erfolgreich korrigiert <-";
 }
}
    mysqli_close($dbcon);
    echo json_encode($data);

?>