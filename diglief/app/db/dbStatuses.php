<?php
include 'db_connection.php';

$conn = OpenCon();

$data = json_decode(file_get_contents("php://input"));
$output = array();

if (count($data) > 0) {

    $target = $data->target;

    if ($target === 'getStatusOffice') {
        $query = "SELECT * FROM fehler_buero";

    } else if ($target === 'getStatusIPoint') {
        $query = "SELECT * FROM fehler_ipunkt";

    } else if ($target === 'getStatusLoading') {
        $query = "SELECT * FROM fehler_verladung";

    } else if ($target === 'addStatusOffice') {
        $ID = $data->ID;
        $Text = mysqli_real_escape_string($conn, $data->Text);
        $query = "INSERT INTO fehler_buero(ID, Text) VALUES ('$ID', '$Text')";

    } else if ($target === 'addStatusIPoint') {
        $ID = $data->ID;
        $Text = mysqli_real_escape_string($conn, $data->Text);
        $query = "INSERT INTO fehler_ipunkt(ID, Text) VALUES ('$ID', '$Text')";

    } else if ($target === 'addStatusLoading') {
        $ID = $data->ID;
        $Text = mysqli_real_escape_string($conn, $data->Text);
        $query = "INSERT INTO fehler_verladung(ID, Text) VALUES ('$ID', '$Text')";

    } else if ($target === 'updateStatusOffice') {
        $ID = $data->ID;
        $newID = $data->newID;
        $Text = mysqli_real_escape_string($conn, $data->Text);
        $query = "UPDATE fehler_buero SET ID = '$newID', Text = '$Text' WHERE ID = '$ID'";

    } else if ($target === 'updateStatusIPoint') {
        $ID = $data->ID;
        $newID = $data->newID;
        $Text = mysqli_real_escape_string($conn, $data->Text);
        $query = "UPDATE fehler_ipunkt SET ID = '$newID', Text = '$Text' WHERE ID = '$ID'";

    } else if ($target === 'updateStatusLoading') {
        $ID = $data->ID;
        $newID = $data->newID;
        $Text = mysqli_real_escape_string($conn, $data->Text);
        $query = "UPDATE fehler_verladung SET ID = '$newID', Text = '$Text' WHERE ID = '$ID'";

    } else if ($target === 'deleteStatusOffice') {
        $ID = $data->ID;
        $query = "DELETE FROM fehler_buero WHERE ID='$ID'";

    } else if ($target === 'deleteStatusIPoint') {
        $ID = $data->ID;
        $query = "DELETE FROM fehler_ipunkt WHERE ID='$ID'";

    } else if ($target === 'deleteStatusLoading') {
        $ID = $data->ID;
        $query = "DELETE FROM fehler_verladung WHERE ID='$ID'";

    }


    $result = mysqli_query($conn, $query);


    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_array($result)) {
            $output[] = $row;
        }
        echo json_encode($output);
    } else {



    }
}