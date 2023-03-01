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
$prio = array();


// Abfrage ob Barcode input leer
if(empty($form_data->barcode_scanver))
{
 $error1["barcode_scanver"] = "Bitte den Barcode einscannen!";
 $data["error1"] = $error1;
}

// Abfrage ob Auftrag in datenbank vorhanden
if(!empty($form_data->barcode_scanver))
{
    $barcode_scanver = mysqli_real_escape_string($dbcon, $form_data->barcode_scanver);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanver' "; 
    $res = $dbcon->query($query);
    if($res->num_rows == 0) {
        $error1["barcode_scanver"] = "Der Auftrag wurde nicht gefunden";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag verpackt
if(!empty($form_data->barcode_scanver))
{
    $barcode_scanver = mysqli_real_escape_string($dbcon, $form_data->barcode_scanver);
    $statever = "";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanver' AND Status_Verpacken = '$statever' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanver"] = "Der Auftrag wurde noch nicht verpackt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag Priorisiert
if(!empty($form_data->barcode_scanver))
{
    $barcode_scanver = mysqli_real_escape_string($dbcon, $form_data->barcode_scanver);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanver' AND Prioritaet_Wareneingang = 'eilig' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $prio["barcode_scanver"] = "<-- Achtung: Der Auftrag ist eilig -->";
        $data["prio"] = $prio;
    }
}

// Abfrage ob Auftrag versendet
if(!empty($form_data->barcode_scanver))
{
    $barcode_scanver = mysqli_real_escape_string($dbcon, $form_data->barcode_scanver);
    $stateversendung= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanver' AND Status_Versendung = '$stateversendung' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanver"] = "Die Ware wurde bereits versendet";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag storniert
if(!empty($form_data->barcode_scanver))
{
    $barcode_scanver = mysqli_real_escape_string($dbcon, $form_data->barcode_scanver);
    $statestorno = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanver' AND Status_Storno = '$statestorno' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanver"] = "Der Auftrag wurde Storniert";
        $data["error1"] = $error1;
    }
}


// Abfrage Länge
if(empty($form_data->input_l))
{
 $error2["input_l"] = "Länge?";
 $data["error2"] = $error2;
}

// Abfrage Breite
if(empty($form_data->input_b))
{
 $error3["input_b"] = "Breite?";
 $data["error3"] = $error3;
}

// Abfrage Höhe
if(empty($form_data->input_h))
{
 $error4["input_h"] = "Höhe?";
 $data["error4"] = $error4;
}

// Abfrage Gewicht
if(empty($form_data->input_g))
{
 $error5["input_g"] = "Gewicht?";
 $data["error5"] = $error5;
}

if(empty($error1) && empty($error2) && empty($error3) && empty($error4) && empty($error5))
{
 $barcode_scanver = mysqli_real_escape_string($dbcon, $form_data->barcode_scanver); 
 $input_l = mysqli_real_escape_string($dbcon, $form_data->input_l);
 $input_b = mysqli_real_escape_string($dbcon, $form_data->input_b);
 $input_h = mysqli_real_escape_string($dbcon, $form_data->input_h);
 $input_g = mysqli_real_escape_string($dbcon, $form_data->input_g);


 $query = "UPDATE versendungen SET Abmessung_cm='$input_l*$input_b*$input_h', Gewicht_kg='$input_g' Where referenznr = '$barcode_scanver'";
 if(mysqli_query($dbcon, $query))
 {
  $data["message"] = "-> Der Auftrag wurde erfolgreich korrigiert <-";
 }
}
    mysqli_close($dbcon);
    echo json_encode($data);

?>