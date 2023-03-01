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
$connect = mysqli_connect('127.0.0.1', "root", "", "paketzentrum");
$form_data = json_decode(file_get_contents("php://input"));
$data = array();
$error1 = array();
$error2 = array();
$error3 = array();


// Abfrage ob Barcode input leer
if(empty($form_data->barcode_scanverpres))
{
 $error1["barcode_scanverpres"] = "Bitte den Barcode einscannen!";
 $data["error1"] = $error1;
}

// Abfrage ob Auftrag in datenbank vorhanden
if(!empty($form_data->barcode_scanverpres))
{
    $barcode_scanverpres = mysqli_real_escape_string($connect, $form_data->barcode_scanverpres);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanverpres' "; 
    $res = $connect->query($query);
    if($res->num_rows == 0) {
        $error1["barcode_scanverpres"] = "Der Auftrag wurde nicht gefunden";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag bereitgestellt
if(!empty($form_data->barcode_scanverpres))
{
    $barcode_scanverpres = mysqli_real_escape_string($connect, $form_data->barcode_scanverpres);
    $statebereit= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanverpres' AND Status_Bereitstellung = '$statebereit' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanverpres"] = "Die Ware wurde bereits bereitgestellt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag Transportpapiere erstellt
if(!empty($form_data->barcode_scanverpres))
{
    $barcode_scanverpres = mysqli_real_escape_string($connect, $form_data->barcode_scanverpres);
    $statetransport= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanverpres' AND Status_Transportpapiere = '$statetransport' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanverpres"] = "Es wurden bereits Transportpapiere erstellt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag versendet
if(!empty($form_data->barcode_scanverpres))
{
    $barcode_scanverpres = mysqli_real_escape_string($connect, $form_data->barcode_scanverpres);
    $stateversendung= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanverpres' AND Status_Versendung = '$stateversendung' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanverpres"] = "Die Ware wurde bereits versendet";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag nicht verpackt
if(!empty($form_data->barcode_scanverpres))
{
    $barcode_scanverpres= mysqli_real_escape_string($connect, $form_data->barcode_scanverpres);
    $stateverp = "";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanverpres' AND Status_Verpacken = '$stateverp' "; 
    $res = $connect->query($query);
    if($res->num_rows > 0) {
        $error1["barcode_scanverpres"] = "Der Auftrag wurde noch nicht verpackt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag storniert
if(!empty($form_data->barcode_scanverpres))
{
    $barcode_scanverpres= mysqli_real_escape_string($connect, $form_data->barcode_scanverpres);
    $statestorno = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanverpres' AND Status_Storno = '$statestorno' "; 
    $res = $connect->query($query);
    if($res->num_rows > 0) {
        $error1["barcode_scanverpres"] = "Der Auftrag wurde bereits storniert";
        $data["error1"] = $error1;
    }
}

if(empty($error1))
{
    $barcode_scanverpres= mysqli_real_escape_string($connect, $form_data->barcode_scanverpres); 
    $input_VKS_Verpacken = "";
    $input_Abmessung = "";
    $input_Gewicht = "";  
    $datum = "";
    $uhrzeit = "";
    $stateverpres = "";
   
    $query = "UPDATE versendungen SET Datum_verpacken ='$datum', Zeit_verpacken='$uhrzeit', Bearbeiter_VKS_Verpacken='$input_VKS_Verpacken', Abmessung_cm='$input_Abmessung', Gewicht_kg='$input_Abmessung', Status_Verpacken='$stateverpres' Where referenznr='$barcode_scanverpres'";
    if(mysqli_query($connect, $query))
    {
     $data["message"] = "-> Der Status wurde erfolgreich zurückgesetzt <-";
    }
   }

   echo json_encode($data);

?>