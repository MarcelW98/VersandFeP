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
$error4 = array();


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
    if($res->num_rows >0) {
        $error1["barcode_scan"] = "Der Auftrag ist in der Datenbank schon vorhanden";
        $data["error1"] = $error1;
    }
}


// Abfrage ob Auftrag verpackt
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($dbcon, $form_data->barcode_scan);
    $statever = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan' AND Status_Verpacken = '$statever' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scan"] = "Der Auftrag wurde schon verpackt";
        $data["error1"] = $error1;
    }
}
// Abfrage ob Auftrag bereitgestellt
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($dbcon, $form_data->barcode_scan);
    $statebereit = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan' AND Status_Bereitstellung = '$statebereit' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scan"] = "Der Auftrag wurde schon bereitgestellt";
        $data["error1"] = $error1;
    }
}
// Abfrage ob Transportpapiere erstellt
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($dbcon, $form_data->barcode_scan);
    $statetransport= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan' AND Status_Transportpapiere = '$statetransport' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scan"] = "Die Transportpapiere wurden schon erstellt";
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


// Abfrage ob Auftrag storniert/annahmeverweigert
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($dbcon, $form_data->barcode_scan);
    $barcode_scan = "AV_" . $barcode_scan . "";
    $statestorno = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan' AND Status_Storno = '$statestorno' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scan"] = "Der Auftrag wurde bereits Annahmeverweigert / Storniert";
        $data["error1"] = $error1;
    }
}



// Abfrage input Grund
if(empty($form_data->input_Grund))
{
 $error2["input_Grund"] = "Grund wird benötigt!";
 $data["error2"] = $error2;
}

// Abfrage input Bearbeiter
if(empty($form_data->input_Wareneingbearbeiter))
{
 $error3["input_Wareneingbearbeiter"] = "Bitte VKS Nr. eingeben!";
 $data["error3"] = $error3;
}

// Abfrage input Hinweis
if(empty($form_data->input_Hinweis))
{
 $error4["input_Hinweis"] = "Hinweis wird benötigt!";
 $data["error4"] = $error4;
}




if(empty($error1) && empty($error2) && empty($error3) && empty($error4))
{ 
 $barcode_scan = mysqli_real_escape_string($dbcon, $form_data->barcode_scan);
 $barcode_scan = "AV_" . $barcode_scan . ""; 
 $input_Grund = mysqli_real_escape_string($dbcon, $form_data->input_Grund);
 $input_Hinweis = mysqli_real_escape_string($dbcon, $form_data->input_Hinweis);
 $input_Wareneingbearbeiter = "1"; //mysqli_real_escape_string($dbcon, $form_data->input_Wareneingbearbeiter);
 $input_GB = "unbekannt";
 $input_Prio = "keine";
 $storno_Grund = "" . $input_Grund . " -> " . $input_Hinweis . "";
 $datum = date("d.m.Y");
 $uhrzeit = date("H:i:s");
 $statewa = "1";
 $statestorno = "1";



 $query = "INSERT INTO versendungen(referenznr, Datum_Wareneingang, Zeit_Wareneingang, Auftragsart_Wareneingang, GB_Wareneingang, Hinweis_Wareneingang, Prioritaet_Wareneingang, Bearbeiter_VKS_Wareneingang, Status_Wareneingang, Datum_Storno, Zeit_Storno, Grund_Storno, Barbeiter_VKS_Storno, Status_Storno)
 VALUES ('$barcode_scan', '$datum', '$uhrzeit', '$input_Grund', '$input_GB', '$input_Hinweis', '$input_Prio', '$input_Wareneingbearbeiter', '$statewa', '$datum', '$uhrzeit', '$storno_Grund', '$input_Wareneingbearbeiter', '$statestorno')";
 if(mysqli_query($dbcon, $query))
 {
  $data["message"] = "-> Annahmeverweigerung erfasst <-";
 }
}
    mysqli_close($dbcon);
    echo json_encode($data);


?>