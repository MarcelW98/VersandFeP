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


// Abfrage ob Barcode input leer
if(empty($form_data->barcode_scanstorno))
{
 $error1["barcode_scanstorno"] = "Bitte den Barcode einscannen!";
 $data["error1"] = $error1;
}

// Abfrage ob Auftrag in datenbank vorhanden
if(!empty($form_data->barcode_scanstorno))
{
    $barcode_scanstorno = mysqli_real_escape_string($dbcon, $form_data->barcode_scanstorno);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanstorno' "; 
    $res = $dbcon->query($query);
    if($res->num_rows == 0) {
        $error1["barcode_scanstorno"] = "Der Auftrag wurde nicht gefunden";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag Annahmeverweigert
if(!empty($form_data->barcode_scanstorno))
{
    $barcode_scanstorno = mysqli_real_escape_string($dbcon, $form_data->barcode_scanstorno);
    $stornogrund = "Annahmeverweigerung";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanstorno' AND Auftragsart_Wareneingang = '$stornogrund' "; 
    $res = $dbcon->query($query);
    if($res->num_rows > 0) {
        $error1["barcode_scanstorno"] = "Der Auftrag wurde Annahmeverweigert. Status zurücksetzen nicht möglich";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag versendet
if(!empty($form_data->barcode_scanstorno))
{
    $barcode_scanstorno = mysqli_real_escape_string($dbcon, $form_data->barcode_scanstorno);
    $stateversendung= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanstorno' AND Status_Versendung = '$stateversendung' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanstorno"] = "Die Ware wurde bereits versendet";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag storniert
if(!empty($form_data->barcode_scanstorno))
{
    $barcode_scanstorno = mysqli_real_escape_string($dbcon, $form_data->barcode_scanstorno);
    $statestorno = "";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanstorno' AND Status_Storno = '$statestorno' "; 
    $res = $dbcon->query($query);
    if($res->num_rows > 0) {
        $error1["barcode_scanstorno"] = "Der Auftrag wurde noch nicht Storniert";
        $data["error1"] = $error1;
    }
}


if(empty($error1))
{
    $barcode_scanstorno= mysqli_real_escape_string($dbcon, $form_data->barcode_scanstorno); 
    $input_Grund = "";
    $input_Stornobearbeiter = ""; 
    $datum = "";
    $uhrzeit = "";
    $statestorno = "";
   
    $query = "UPDATE versendungen SET Datum_Storno='$datum', Zeit_Storno='$uhrzeit', Grund_Storno='$input_Grund', Barbeiter_VKS_Storno='$input_Stornobearbeiter', Status_Storno='$statestorno' Where referenznr='$barcode_scanstorno'";
    if(mysqli_query($dbcon, $query))
    {
     $data["message"] = "-> Der storno Status wurde erfolgreich zurückgesetzt <-";
    }
   }
   mysqli_close($dbcon);
   echo json_encode($data);

?>