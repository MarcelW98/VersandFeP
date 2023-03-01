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
$error5 = array();
$error6 = array();
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
    $barcode_scanver = mysqli_real_escape_string($connect, $form_data->barcode_scanver);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanver' "; 
    $res = $connect->query($query);
    If($res->num_rows == 0) {
        $error1["barcode_scanver"] = "Der Auftrag wurde nicht gefunden";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag verpackt
if(!empty($form_data->barcode_scanver))
{
    $barcode_scanver = mysqli_real_escape_string($connect, $form_data->barcode_scanver);
    $statever = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanver' AND Status_Verpacken = '$statever' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanver"] = "Der Auftrag wurde schon verpackt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag Priorisiert
if(!empty($form_data->barcode_scanver))
{
    $barcode_scanver = mysqli_real_escape_string($connect, $form_data->barcode_scanver);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanver' AND Prioritaet_Wareneingang = 'eilig' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $prio["barcode_scanver"] = "<-- Achtung: Der Auftrag ist eilig -->";
        $data["prio"] = $prio;
    }
}

// Abfrage ob Auftrag bereitgestellt
if(!empty($form_data->barcode_scanver))
{
    $barcode_scanver = mysqli_real_escape_string($connect, $form_data->barcode_scanver);
    $statebereit = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanver' AND Status_Bereitstellung = '$statebereit' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanver"] = "Der Auftrag wurde schon bereitgestellt";
        $data["error1"] = $error1;
    }
}
// Abfrage ob Transportpapiere erstellt
if(!empty($form_data->barcode_scanver))
{
    $barcode_scanver = mysqli_real_escape_string($connect, $form_data->barcode_scanver);
    $statetransport= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanver' AND Status_Transportpapiere = '$statetransport' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanver"] = "Die Transportpapiere wurden schon erstellt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag versendet
if(!empty($form_data->barcode_scanver))
{
    $barcode_scanver = mysqli_real_escape_string($connect, $form_data->barcode_scanver);
    $stateversendung= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanver' AND Status_Versendung = '$stateversendung' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanver"] = "Die Ware wurde bereits versendet";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag storniert
if(!empty($form_data->barcode_scanver))
{
    $barcode_scanver = mysqli_real_escape_string($connect, $form_data->barcode_scanver);
    $statestorno = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanver' AND Status_Storno = '$statestorno' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanver"] = "Der Auftrag wurde Storniert";
        $data["error1"] = $error1;
    }
}

// Abfrage Bearbeiter
if(empty($form_data->input_Verpackbearbeiter))
{
 $error2["input_Verpackbearbeiter"] = "Bitte VKS Nr. eingeben!";
 $data["error2"] = $error2;
}

// Abfrage Länge
if(empty($form_data->input_l))
{
 $error3["input_l"] = "Länge?";
 $data["error3"] = $error3;
}

// Abfrage Breite
if(empty($form_data->input_b))
{
 $error4["input_b"] = "Breite?";
 $data["error4"] = $error4;
}

// Abfrage Höhe
if(empty($form_data->input_h))
{
 $error5["input_h"] = "Höhe?";
 $data["error5"] = $error5;
}

// Abfrage Gewicht
if(empty($form_data->input_g))
{
 $error6["input_g"] = "Gewicht?";
 $data["error6"] = $error6;
}

if(empty($error1) && empty($error2) && empty($error3) && empty($error4) && empty($error5) && empty($error6))
{
 $barcode_scanver = mysqli_real_escape_string($connect, $form_data->barcode_scanver); 
 $input_Verpackbearbeiter = mysqli_real_escape_string($connect, $form_data->input_Verpackbearbeiter);
 $input_l = mysqli_real_escape_string($connect, $form_data->input_l);
 $input_b = mysqli_real_escape_string($connect, $form_data->input_b);
 $input_h = mysqli_real_escape_string($connect, $form_data->input_h);
 $input_g = mysqli_real_escape_string($connect, $form_data->input_g);
 $datum = date("d.m.Y");
 $uhrzeit = date("H:i:s");
 $stateverpa = "1";
 $stateklaer = "";

 $query = "UPDATE versendungen SET Datum_verpacken='$datum', Zeit_verpacken ='$uhrzeit', Bearbeiter_VKS_Verpacken='$input_Verpackbearbeiter', Abmessung_cm='$input_l*$input_b*$input_h', Gewicht_kg='$input_g', Status_Verpacken='$stateverpa', Status_Klaerung='$stateklaer' Where referenznr = '$barcode_scanver'";
 if(mysqli_query($connect, $query))
 {
  $data["message"] = "-> Der Auftrag wurde gespeichert <-";
 }
}

echo json_encode($data);

?>