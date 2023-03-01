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
$prio = array();


// Abfrage ob Barcode input leer
if(empty($form_data->barcode_scanbereit))
{
 $error1["barcode_scanbereit"] = "Bitte den Barcode einscannen!";
 $data["error1"] = $error1;
}

// Abfrage ob Auftrag in datenbank vorhanden
if(!empty($form_data->barcode_scanbereit))
{
    $barcode_scanbereit = mysqli_real_escape_string($connect, $form_data->barcode_scanbereit);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereit' "; 
    $res = $connect->query($query);
    if($res->num_rows == 0) {
        $error1["barcode_scanbereit"] = "Der Auftrag wurde nicht gefunden";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag verpackt
if(!empty($form_data->barcode_scanbereit))
{
    $barcode_scanbereit = mysqli_real_escape_string($connect, $form_data->barcode_scanbereit);
    $statever = "";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereit' AND Status_Verpacken = '$statever' "; 
    $res = $connect->query($query);
    if($res->num_rows > 0) {
        $error1["barcode_scanbereit"] = "Der Auftrag wurde noch nicht verpackt";
        $data["error1"] = $error1;
    }
}
// Abfrage ob Auftrag bereitgestellt
if(!empty($form_data->barcode_scanbereit))
{
    $barcode_scanbereit = mysqli_real_escape_string($connect, $form_data->barcode_scanbereit);
    $statebereit = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereit' AND Status_Bereitstellung = '$statebereit' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanbereit"] = "Der Auftrag wurde schon bereitgestellt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag Priorisiert
if(!empty($form_data->barcode_scanbereit))
{
    $barcode_scanbereit = mysqli_real_escape_string($connect, $form_data->barcode_scanbereit);
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereit' AND Prioritaet_Wareneingang = 'eilig' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $prio["barcode_scanbereit"] = "<-- Achtung: Der Auftrag ist eilig -->";
        $data["prio"] = $prio;
    }
}

// Abfrage ob Transportpapiere erstellt
if(!empty($form_data->barcode_scanbereit))
{
    $barcode_scanbereit = mysqli_real_escape_string($connect, $form_data->barcode_scanbereit);
    $statetransport= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereit' AND Status_Transportpapiere = '$statetransport' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanbereit"] = "Die Transportpapiere wurden schon erstellt";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag versendet
if(!empty($form_data->barcode_scanbereit))
{
    $barcode_scanbereit = mysqli_real_escape_string($connect, $form_data->barcode_scanbereit);
    $stateversendung= "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereit' AND Status_Versendung = '$stateversendung' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanbereit"] = "Die Ware wurde bereits versendet";
        $data["error1"] = $error1;
    }
}

// Abfrage ob Auftrag storniert
if(!empty($form_data->barcode_scanbereit))
{
    $barcode_scanbereit = mysqli_real_escape_string($connect, $form_data->barcode_scanbereit);
    $statestorno = "1";
    $query = "SELECT * FROM versendungen Where referenznr = '$barcode_scanbereit' AND Status_Storno = '$statestorno' "; 
    $res = $connect->query($query);
    if($res->num_rows >0) {
        $error1["barcode_scanbereit"] = "Der Auftrag wurde Storniert";
        $data["error1"] = $error1;
    }
}

// Abfrage input Lieferschein
if(empty($form_data->input_Lieferschein))
{
 $error2["input_Lieferschein"] = "Bitte Lieferschein einscannen";
 $data["error2"] = $error2;
}

// Abfrage input Lieferschein eingabelänge
if(!empty($form_data->input_Lieferschein))
{
    if(strlen($form_data->input_Lieferschein) != 10)
    {
     $error2["input_Lieferschein"] = "Lieferscheinnummer hat falsche länge";
     $data["error2"] = $error2;
    }
}

// Abfrage input weitere Bearbeitung
if(empty($form_data->input_Bearbeitung))
{
 $error3["input_Bearbeitung"] = "Bitte den weiteren Bearbeiter eingeben";
 $data["error3"] = $error3;
}

// Abfrage input Länderhinweis
if(empty($form_data->input_Lhinweis))
{
 $error4["input_Lhinweis"] = "Bitte den Länderhinweis auswählen!";
 $data["error4"] = $error4;
}

// Abfrage input Bearbeiter
if(empty($form_data->input_Bereitbearbeiter))
{
 $error5["input_Bereitbearbeiter"] = "Bitte VKS Nr. eingeben!";
 $data["error5"] = $error5;
}

if(empty($error1) && empty($error2) && empty($error3) && empty($error4) && empty($error5))
{
 $barcode_scanbereit= mysqli_real_escape_string($connect, $form_data->barcode_scanbereit); 
 $input_Lieferschein = mysqli_real_escape_string($connect, $form_data->input_Lieferschein);
 $input_Bearbeitung = mysqli_real_escape_string($connect, $form_data->input_Bearbeitung); 
 $input_Lhinweis = mysqli_real_escape_string($connect, $form_data->input_Lhinweis); 
 $input_Bereitbearbeiter = mysqli_real_escape_string($connect, $form_data->input_Bereitbearbeiter);
 $datum = date("d.m.Y");
 $uhrzeit = date("H:i:s");
 $statebereit = "1";
 $stateklaer = "";

 $query = "UPDATE versendungen SET Datum_Bereitstellung='$datum', Zeit_Bereitstellung='$uhrzeit', Lieferschein='$input_Lieferschein', Weitere_Bearbeitung='$input_Bearbeitung', Laenderhinweis='$input_Lhinweis',Bearbeiter_VKS_Bereitstellung='$input_Bereitbearbeiter', Status_Bereitstellung='$statebereit', Status_Klaerung='$stateklaer' Where referenznr = '$barcode_scanbereit'";
 if(mysqli_query($connect, $query))
 {
  $data["message"] = "-> Der Auftrag wurde gespeichert <-";
 }
}

echo json_encode($data);

?>