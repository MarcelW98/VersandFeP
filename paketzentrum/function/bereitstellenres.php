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
if(empty($form_data->barcode_scanbereitres))
{
 $error1["barcode_scanbereitres"] = "Bitte den Barcode einscannen!";
 $data["error1"] = $error1;
}

// Abfrage ob Auftrag in datenbank vorhanden
if(!empty($form_data->barcode_scanbereitres))
{
    $barcode_scanbereitres = mysqli_real_escape_string($dbcon, $form_data->barcode_scanbereitres);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereitres' "; 
    $res = $dbcon->query($query);
    if($res->num_rows == 0) {
        $error1["barcode_scanbereitres"] = "Der Auftrag wurde nicht gefunden";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag bereitgestellt
if(!empty($form_data->barcode_scanbereitres))
{
    $barcode_scanbereitres = mysqli_real_escape_string($dbcon, $form_data->barcode_scanbereitres);
    $statebereit= "";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereitres' AND Status_Bereitstellung = '$statebereit' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanbereitres"] = "Die Ware wurde noch nicht bereitgestellt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag Transportpapiere erstellt
if(!empty($form_data->barcode_scanbereitres))
{
    $barcode_scanbereitres = mysqli_real_escape_string($dbcon, $form_data->barcode_scanbereitres);
    $statetransport= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereitres' AND Status_Transportpapiere = '$statetransport' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanbereitres"] = "Es wurden bereits Transportpapiere erstellt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag versendet
if(!empty($form_data->barcode_scanbereitres))
{
    $barcode_scanbereitres = mysqli_real_escape_string($dbcon, $form_data->barcode_scanbereitres);
    $stateversendung= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereitres' AND Status_Versendung = '$stateversendung' "; 
    $res = $dbcon->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanbereitres"] = "Die Ware wurde bereits versendet";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag nicht verpackt
if(!empty($form_data->barcode_scanbereitres))
{
    $barcode_scanbereitres= mysqli_real_escape_string($dbcon, $form_data->barcode_scanbereitres);
    $stateverp = "";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereitres' AND Status_Verpacken = '$stateverp' "; 
    $res = $dbcon->query($query);
    if($res->num_rows > 0) {
        $error1["barcode_scanbereitres"] = "Der Auftrag wurde noch nicht verpackt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag storniert
if(!empty($form_data->barcode_scanbereitres))
{
    $barcode_scanbereitres= mysqli_real_escape_string($dbcon, $form_data->barcode_scanbereitres);
    $statestorno = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereitres' AND Status_Storno = '$statestorno' "; 
    $res = $dbcon->query($query);
    if($res->num_rows > 0) {
        $error1["barcode_scanbereitres"] = "Der Auftrag wurde bereits storniert";
        $data["error1"] = $error1;
    }
}

if(empty($error1))
{
    $barcode_scanbereitres= mysqli_real_escape_string($dbcon, $form_data->barcode_scanbereitres); 
    $input_Lieferschein = "";
    $input_Bearbeitung = "";
    $input_Lhinweis = "";
    $input_VKS_Bereitstellung = "";  
    $datum = "";
    $uhrzeit = "";
    $statebereitres = "";
   
    $query = "UPDATE versendungen SET Datum_Bereitstellung ='$datum', Zeit_Bereitstellung='$uhrzeit', Lieferschein='$input_Lieferschein', Weitere_Bearbeitung='$input_Bearbeitung', Laenderhinweis='$input_Lhinweis', Bearbeiter_VKS_Bereitstellung='$input_VKS_Bereitstellung', Status_Bereitstellung ='$statebereitres' Where referenznr='$barcode_scanbereitres'";
    if(mysqli_query($dbcon, $query))
    {
     $data["message"] = "-> Der Status wurde erfolgreich zurückgesetzt <-";
    }
   }
    mysqli_close($dbcon);
    echo json_encode($data);

?>