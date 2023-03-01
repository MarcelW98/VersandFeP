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

{
    $barcode_scanstorno= mysqli_real_escape_string($dbcon, $form_data->barcode_scanstorno); 
    $input_Grund = mysqli_real_escape_string($dbcon, $form_data->input_Grund);
    $input_Stornobearbeiter = "1"; //mysqli_real_escape_string($dbcon, $form_data->input_Stornobearbeiter); 
    $datum = date("d.m.Y");
    $uhrzeit = date("H:i:s");
    $statestorno = "1";
   
    $query = "UPDATE versendungen SET Datum_Storno='$datum', Zeit_Storno='$uhrzeit', Grund_Storno='$input_Grund', Barbeiter_VKS_Storno='$input_Stornobearbeiter', Status_Storno='$statestorno' Where referenznr='$barcode_scanstorno'";
    if(mysqli_query($dbcon, $query))
    {
     $data["message"] = "-> Der Auftrag wurde erfolgreich storniert <-";
    }
   }
    mysqli_close($dbcon);
    echo json_encode($data);

?>