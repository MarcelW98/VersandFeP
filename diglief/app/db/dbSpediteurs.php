<?php
include 'db_connection.php';

$conn = OpenCon();

$data = json_decode(file_get_contents("php://input"));
$output = array();

if (count($data) > 0) {

    $target = $data->target;


    if ($target === 'getSpediteurs') {
        $query = "SELECT * FROM spediteur";

    } else if ($target === 'addSpediteur') {
        $Name = mysqli_real_escape_string($conn, $data->Name);
        $AllocationWindStart = mysqli_real_escape_string($conn, $data->AllocationWindStart);
        $AllocationWindEnd = mysqli_real_escape_string($conn, $data->AllocationWindEnd);
        $Ankunft_Spediteur = mysqli_real_escape_string($conn, $data->Ankunft_Spediteur);
        $Abfahrt_Spediteur = mysqli_real_escape_string($conn, $data->Abfahrt_Spediteur);
        $Bereitstellungszeit = mysqli_real_escape_string($conn, $data->Bereitstellungszeit);
        $Zeitfenster_Spediteur= mysqli_real_escape_string($conn, $data->Zeitfenster_Spediteur);
        $Spaeteste_Abfahrt = mysqli_real_escape_string($conn, $data->Spaeteste_Abfahrt);
        $Bearbeiter = mysqli_real_escape_string($conn, $data->Bearbeiter);
        $Auslager_Zeitfenster = mysqli_real_escape_string($conn, $data->Auslager_Zeitfenster);
        $Auslagerung_Start = mysqli_real_escape_string($conn, $data->Auslagerung_Start);
        $Auslagerung_Ende = mysqli_real_escape_string($conn, $data->Auslagerung_Ende);
        $prioritisation = $data->prioritisation;
        $kPointRelevant = $data->kPointRelevant;

        $query = "INSERT INTO spediteur(Name, AllocationWindStart, AllocationWindEnd, Ankunft_Spediteur, Abfahrt_Spediteur, Bereitstellungszeit, Spaeteste_Abfahrt, Zeitfenster_Spediteur,  Bearbeiter, Auslager_Zeitfenster, Auslagerung_Start, Auslagerung_Ende, prioritisation, kPointRelevant) VALUES ('$Name', '$AllocationWindStart', '$AllocationWindEnd', '$Ankunft_Spediteur', '$Abfahrt_Spediteur', '$Bereitstellungszeit', '$Spaeteste_Abfahrt', '$Zeitfenster_Spediteur', '$Bearbeiter', '$Auslager_Zeitfenster', '$Auslagerung_Start', '$Auslagerung_Ende', '$prioritisation', '$kPointRelevant' )";

    } else if ($target === 'updateSpediteur') {
        $ID = $data->ID;
        $Name = mysqli_real_escape_string($conn, $data->Name);
        $AllocationWindStart = mysqli_real_escape_string($conn, $data->AllocationWindStart);
        $AllocationWindEnd = mysqli_real_escape_string($conn, $data->AllocationWindEnd);
        $Ankunft_Spediteur = mysqli_real_escape_string($conn, $data->Ankunft_Spediteur);
        $Abfahrt_Spediteur = mysqli_real_escape_string($conn, $data->Abfahrt_Spediteur);
        $Bereitstellungszeit = mysqli_real_escape_string($conn, $data->Bereitstellungszeit);
        $Zeitfenster_Spediteur= mysqli_real_escape_string($conn, $data->Zeitfenster_Spediteur);
        $Spaeteste_Abfahrt = mysqli_real_escape_string($conn, $data->Spaeteste_Abfahrt);
        $Bearbeiter = mysqli_real_escape_string($conn, $data->Bearbeiter);
        $Auslager_Zeitfenster = mysqli_real_escape_string($conn, $data->Auslager_Zeitfenster);
        $Auslagerung_Start = mysqli_real_escape_string($conn, $data->Auslagerung_Start);
        $Auslagerung_Ende = mysqli_real_escape_string($conn, $data->Auslagerung_Ende);
        $prioritisation = $data->prioritisation;
        $kPointRelevant = $data->kPointRelevant;

        $query = "UPDATE spediteur SET Name ='$Name' , AllocationWindStart= '$AllocationWindStart', AllocationWindEnd= '$AllocationWindEnd', Ankunft_Spediteur = '$Ankunft_Spediteur', Abfahrt_Spediteur = '$Abfahrt_Spediteur', Bereitstellungszeit = '$Bereitstellungszeit', Spaeteste_Abfahrt = '$Spaeteste_Abfahrt',  Zeitfenster_Spediteur = '$Zeitfenster_Spediteur',  Bearbeiter = '$Bearbeiter', Auslager_Zeitfenster = '$Auslager_Zeitfenster', Auslagerung_Start ='$Auslagerung_Start', Auslagerung_Ende = '$Auslagerung_Ende', prioritisation = '$prioritisation', kPointRelevant = '$kPointRelevant' WHERE ID='$ID'";

    }else if($target === 'deleteSpediteur'){
        $ID = $data->ID;
        $query = "DELETE FROM spediteur WHERE ID='$ID'";
    }
}


$result = mysqli_query($conn, $query);

if(mysqli_num_rows($result) > 0)
{
    while($row = mysqli_fetch_array($result))
    {
        $output[] = $row;
    }
    echo json_encode($output);
}
else
{
    echo $result;
}

CloseCon($conn);