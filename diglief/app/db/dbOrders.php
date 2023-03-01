<?php
include 'db_connection.php';

/** opens connection to the db */
$conn = OpenCon();
$output = array();
$data = json_decode(file_get_contents("php://input", TRUE));
// echo $data;
if ( 1 > 0) { // count($data)

  /** @var  $target
   every http.post command gets a target assigned,
   what it wants to do*/
    $target = $data->target;

    /** depending on the target selects the correct attributes that have to be parsed and the sql */
    if ($target == "addOrder") {
        $Spediteur = mysqli_real_escape_string($conn, $data->Spediteur);
        $Bearbeiter = mysqli_real_escape_string($conn, $data->Bearbeiter);
        $Auslagerung_Ist = $data->Auslagerung_Ist;
        $StorageTimeStart = mysqli_real_escape_string($conn, $data->StorageTimeStart);
        $StorageTimeEnd = mysqli_real_escape_string($conn, $data->StorageTimeEnd);
        $Datum = mysqli_real_escape_string($conn, $data->Datum);
        $Plan_Ankunft = mysqli_real_escape_string($conn, $data->Plan_Ankunft);
        $Plan_Abfahrt = mysqli_real_escape_string($conn, $data->Plan_Abfahrt);
        $Pack_Soll = $data->Pack_Soll;
        $Fehler_Buero = $data->Fehler_Buero;
        $Bereitstellungszeit = mysqli_real_escape_string($conn, $data->Bereitstellungszeit);
        $Spaeteste_Abfahrt = mysqli_real_escape_string($conn, $data->Spaeteste_Abfahrt);
        $Bemerkung = mysqli_real_escape_string($conn, $data->Bemerkung);
        $Priorisierung = $data->Priorisierung;
        $kPointRelevant = $data->kPointRelevant;

        $query = "INSERT INTO auftrag(Spediteur, Bearbeiter, Auslagerung_Ist, StorageTimeStart, StorageTimeEnd, Datum, Plan_Ankunft, Plan_Abfahrt, Pack_Soll, Fehler_Buero, Bemerkung, Priorisierung, kPointRelevant, Bereitstellungszeit, Spaeteste_Abfahrt) VALUES ('$Spediteur', '$Bearbeiter', '$Auslagerung_Ist', '$StorageTimeStart', '$StorageTimeEnd', '$Datum', '$Plan_Ankunft', '$Plan_Abfahrt','$Pack_Soll', '$Fehler_Buero', '$Bemerkung', '$Priorisierung', '$kPointRelevant', '$Bereitstellungszeit', '$Spaeteste_Abfahrt')";

    } else if ($target == "updateOrder") {
        $ID = $data->ID;
        $Aulagerung_Ist = $data->Auslagerung_Ist;
        $Bearbeiter = mysqli_real_escape_string($conn, $data->Bearbeiter);
        $Bemerkung = mysqli_real_escape_string($conn, $data->Bemerkung);
        $Datum = mysqli_real_escape_string($conn, $data->Datum);
        $Durchsprache = $data->Durchsprache;
        $Ausgelagert = $data->Ausgelagert;
        $Fehler_Buero = $data->Fehler_Buero;
        $Fehler_IPunkt1 = $data->Fehler_IPunkt1;
        $Fehler_IPunkt2 = $data->Fehler_IPunkt2;
        $Fehler_IPunkt3 = $data->Fehler_IPunkt3;
        $Fehler_Verladung1 = $data->Fehler_Verladung1;
        $Fehler_Verladung2 = $data->Fehler_Verladung2;
        $Fehler_Verladung3 = $data->Fehler_Verladung3;
        $Ist_Abfahrt = mysqli_real_escape_string($conn, $data->Ist_Abfahrt);
        $Ist_Ankunft = mysqli_real_escape_string($conn, $data->Ist_Ankunft);
        $Pack_Soll = $data->Pack_Soll;

        $Plan_Ankunft = mysqli_real_escape_string($conn, $data->Plan_Ankunft);
        $Plan_Abfahrt = mysqli_real_escape_string($conn, $data->Plan_Abfahrt);
        $Priorisierung = $data->Priorisierung;
        $Spediteur = mysqli_real_escape_string($conn, $data->Spediteur);


        $Versand = $data->Versand;

        $query = "UPDATE auftrag SET Auslagerung_Ist = '$Aulagerung_Ist', Bearbeiter= '$Bearbeiter', Bemerkung = '$Bemerkung', Datum = '$Datum', Durchsprache = '$Durchsprache', Ausgelagert = '$Ausgelagert', Fehler_Buero = '$Fehler_Buero', Fehler_IPunkt1 = '$Fehler_IPunkt1', Fehler_IPunkt2 = '$Fehler_IPunkt2', Fehler_IPunkt3 = '$Fehler_IPunkt3', Fehler_Verladung1 = '$Fehler_Verladung1', Fehler_Verladung2 = '$Fehler_Verladung2', Fehler_Verladung3 = '$Fehler_Verladung3', Ist_Abfahrt = '$Ist_Abfahrt', Ist_Ankunft = '$Ist_Ankunft', Pack_Soll = '$Pack_Soll', Plan_Abfahrt = '$Plan_Abfahrt', Plan_Ankunft = '$Plan_Ankunft', Priorisierung = '$Priorisierung', Spediteur = '$Spediteur',  Versand = '$Versand' WHERE ID = '$ID'";

    } else if ($target == "getBuero") {

        $filterDateStart = $data->filterDateStart;
        $filterDateEnd = $data->filterDateEnd;
        $filterSend = $data->filterSend;
        $Bearbeiter = $data->Bearbeiter;

        if($filterSend === TRUE){
            $filterSend = 1;
        }else if($filterSend === FALSE){
            $filterSend = 0;
        }
        $query = "SELECT * FROM  auftrag WHERE Datum > DATE_SUB(DATE('$filterDateStart'), INTERVAL 1 DAY) AND Datum < DATE_ADD(DATE('$filterDateEnd'), INTERVAL 1 DAY) AND Versand = $filterSend";
                                if($Bearbeiter != ""){
                                    $Bearbeiter =mysqli_real_escape_string($conn, $data->Bearbeiter);
                                    $query .=" AND Bearbeiter LIKE '%$Bearbeiter%'";
                                }

    } else if ($target == "getIPunkt") {
        //$query = "SELECT * FROM  auftrag WHERE Pack_Soll != Auslagerung_Ist AND kPointRelevant != 0";
         $query = "SELECT * FROM  auftrag WHERE Ausgelagert != 1 AND kPointRelevant != 0";
    } else if ($target == "getVerladung") {
        $query = "SELECT * FROM  auftrag WHERE Versand=0 AND (Ausgelagert = 1 OR kPointRelevant != 1)";
    } else if ($target == "getMonitor") {
        $filterDateStart = $data->filterDateStart;
        $filterDateEnd = $data->filterDateEnd;
        $filterSend = $data->filterSend;
        $Bearbeiter = $data->Bearbeiter;        
        $Versand = $data->Versand;        
        if($Versand === true){
            $query = "SELECT * FROM auftrag WHERE Datum = CURDATE() OR Date(Versanddatum) = CURDATE() OR (Versand = 0 AND Datum < DATE_ADD(DATE(CURDATE()), INTERVAL 1 DAY)) ";
            //$query = "SELECT * FROM  auftrag WHERE Versand = 0 OR((Durchsprache=0 AND (Fehler_IPunkt1 != 0 OR Fehler_IPunkt2 != 0 OR Fehler_IPunkt3 != 0 OR Fehler_Verladung1 != 0 OR Fehler_Verladung2 != 0 OR Fehler_Verladung3 != 0)) OR (Durchsprache=1 AND DurchspracheDatum >= (NOW() - INTERVAL 30 MINUTE)))";
        }else {
            $query = "SELECT * FROM  auftrag WHERE (Durchsprache=0 AND (Fehler_IPunkt1 != 0 OR Fehler_IPunkt2 != 0 OR Fehler_IPunkt3 != 0 OR Fehler_Verladung1 != 0 OR Fehler_Verladung2 != 0 OR Fehler_Verladung3 != 0)) OR (Durchsprache=1 AND DurchspracheDatum >= (NOW() - INTERVAL 30 MINUTE))";

        }
        if($filterSend === true){
            $query = "SELECT * FROM  auftrag WHERE Datum > DATE_SUB(DATE('$filterDateStart'), INTERVAL 1 DAY) AND Datum < DATE_ADD(DATE('$filterDateEnd'), INTERVAL 1 DAY)";
                                if($Bearbeiter != ""){
                                    $Bearbeiter =mysqli_real_escape_string($conn, $data->Bearbeiter);
                                    $query .=" AND Bearbeiter LIKE '%$Bearbeiter%'";
                                }
        }
    } else if ($target == "deleteOrder") {
        $ID = $data->ID;
        $query = "DELETE FROM auftrag WHERE ID='$ID'";
    } else if ($target == "setAuslagerTime") {
        $ID = $data->ID;
        $query = "UPDATE auftrag SET Auslagerzeit = CURRENT_TIMESTAMP WHERE ID = '$ID'";
    }else if ($target == "setVersandDatum") {
        $ID = $data->ID;
        $query = "UPDATE auftrag SET Versanddatum = CURRENT_TIMESTAMP WHERE ID = '$ID'";
    }else if ($target == "setDurchspracheDatum") {
        $ID = $data->ID;
        $query = "UPDATE auftrag SET DurchspracheDatum = CURRENT_TIMESTAMP WHERE ID = '$ID'";
    }


    $result = mysqli_query($conn, $query);


    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
        echo json_encode($output);
    } else {
      echo false;
    }


}


CloseCon($conn);
