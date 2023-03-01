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

// Abfrage ob Barcode input leer
if(empty($form_data->barcode_scan))
{
 $error1["barcode_scan"] = "Bitte den Barcode einscannen!";
 $data["error1"] = $error1;
}
// Abfrage ob Datensatz schon in Datenbank
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($connect, $form_data->barcode_scan);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan'"; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scan"] = "Der Auftrag ist in der Datenbank schon vorhanden";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag verpackt
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($connect, $form_data->barcode_scan);
    $statever = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan' AND Status_Verpacken = '$statever' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scan"] = "Der Auftrag wurde schon verpackt";
        $data["error1"] = $error1;
    }
}
// Abfrage ob Auftrag bereitgestellt
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($connect, $form_data->barcode_scan);
    $statebereit = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan' AND Status_Bereitstellung = '$statebereit' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scan"] = "Der Auftrag wurde schon bereitgestellt";
        $data["error1"] = $error1;
    }
}
// Abfrage ob Transportpapiere erstellt
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($connect, $form_data->barcode_scan);
    $statetransport= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan' AND Status_Transportpapiere = '$statetransport' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scan"] = "Die Transportpapiere wurden schon erstellt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag versendet
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($connect, $form_data->barcode_scan);
    $stateversendung= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan' AND Status_Versendung = '$stateversendung' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scan"] = "Die Ware wurde bereits versendet";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag storniert
if(!empty($form_data->barcode_scan))
{
    $barcode_scan = mysqli_real_escape_string($connect, $form_data->barcode_scan);
    $statestorno = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scan' AND Status_Storno = '$statestorno' "; 
    $res = $connect->query($query);
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

// Abfrage input Bearbeiter
if(empty($form_data->input_Wareneingbearbeiter))
{
 $error5["input_Wareneingbearbeiter"] = "Bitte VKS Nr. eingeben!";
 $data["error5"] = $error5;
}

// Abfrage input Hinweis
if(empty($form_data->input_Hinweis))
{
 $error6["input_Hinweis"] = "Hinweis wird benötigt!";
 $data["error6"] = $error6;
}

if(empty($error1) && empty($error2) && empty($error3) && empty($error4) && empty($error5) && empty($error6))
{ 
 $barcode_scan = mysqli_real_escape_string($connect, $form_data->barcode_scan); 
 $input_Auftragsart = mysqli_real_escape_string($connect, $form_data->input_Auftragsart);
 $input_GB = mysqli_real_escape_string($connect, $form_data->input_GB);
 $input_Wareneingbearbeiter = mysqli_real_escape_string($connect, $form_data->input_Wareneingbearbeiter);
 $input_Hinweis = mysqli_real_escape_string($connect, $form_data->input_Hinweis);
 $input_Prio = mysqli_real_escape_string($connect, $form_data->input_Prio);
 $datum = date("d.m.Y");
 $uhrzeit = date("H:i:s");
 $statewa = "1";

 $query = "INSERT INTO versendungen(referenznr, Datum_Wareneingang, Zeit_Wareneingang, Auftragsart_Wareneingang, GB_Wareneingang, Hinweis_Wareneingang, Prioritaet_Wareneingang, Bearbeiter_VKS_Wareneingang, Status_Wareneingang)
 VALUES ('$barcode_scan', '$datum', '$uhrzeit', '$input_Auftragsart', '$input_GB', '$input_Hinweis', '$input_Prio', '$input_Wareneingbearbeiter', '$statewa')";
 if(mysqli_query($connect, $query))
 {
  $data["message"] = "-> Der Auftrag wurde gespeichert <-";
 }
}

echo json_encode($data);


?>