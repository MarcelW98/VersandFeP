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

// Abfrage ob Barcode input leer
if(empty($form_data->barcode_scanstorno))
{
 $error1["barcode_scanstorno"] = "Bitte den Barcode einscannen!";
 $data["error1"] = $error1;
}

// Abfrage ob Auftrag in datenbank vorhanden
if(!empty($form_data->barcode_scanstorno))
{
    $barcode_scanstorno = mysqli_real_escape_string($connect, $form_data->barcode_scanstorno);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanstorno' "; 
    $res = $connect->query($query);
    if($res->num_rows == 0) {
        $error1["barcode_scanstorno"] = "Der Auftrag wurde nicht gefunden";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag versendet
if(!empty($form_data->barcode_scanstorno))
{
    $barcode_scanstorno = mysqli_real_escape_string($connect, $form_data->barcode_scanstorno);
    $stateversendung= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanstorno' AND Status_Versendung = '$stateversendung' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanstorno"] = "Die Ware wurde bereits versendet";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag storniert
if(!empty($form_data->barcode_scanstorno))
{
    $barcode_scanstorno = mysqli_real_escape_string($connect, $form_data->barcode_scanstorno);
    $statestorno = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanstorno' AND Status_Storno = '$statestorno' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanstorno"] = "Der Auftrag wurde bereits Storniert";
        $data["error1"] = $error1;
    }
}

// Abfrage input Grund
if(empty($form_data->input_Grund))
{
 $error2["input_Grund"] = "Bitte den Grund der Stornierung angeben!";
 $data["error2"] = $error2;
}

// Abfrage input Bearbeiter
if(empty($form_data->input_Stornobearbeiter))
{
 $error3["input_Stornobearbeiter"] = "Bitte VKS Nr. eingeben!";
 $data["error3"] = $error3;
}

   echo json_encode($data);

?>