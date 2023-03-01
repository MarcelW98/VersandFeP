<?php
include 'db_connection.php';

$conn = OpenCon();
$output = array();
$data = json_decode(file_get_contents("php://input"));

if(count($data) > 0){
    $target = $data->target;

    if($target === 'login'){
        $User = mysqli_real_escape_string($conn, $data->User);
        $Password=hash("sha512", mysqli_real_escape_string($conn, $data->Password));
        $pw = mysqli_real_escape_string($conn, $data->Password);
        $query="SELECT `Group` FROM `usermng` WHERE `User`='$User' AND (`Password`='$Password' OR `Password`='$pw')";

    } else if ($target === 'getUser'){

        $query="SELECT * FROM usermng";

    } else if ($target === 'changePW'){
        $ID = $data->ID;
        $Password=hash("sha512", mysqli_real_escape_string($conn, $data->Password));

        $query = "UPDATE usermng SET Password='$Password' WHERE ID='$ID'";
    } else if ($target === 'addUser'){
        $User = mysqli_real_escape_string($conn, $data->User);
        $Password=hash("sha512", mysqli_real_escape_string($conn, $data->Password));
        $Group = mysqli_real_escape_string($conn, $data->Group);

        $query = "INSERT INTO usermng (`User`,`Password`,`Group`) VALUES ('$User', '$Password', '$Group')";
    } else if ($target === 'deleteUser') {
        $ID = $data->ID;
        if($ID != 1){
            $query = "DELETE FROM usermng WHERE ID='$ID'";
        }

    } else if ($target === 'checkUser'){
        $User = mysqli_real_escape_string($conn, $data->User);
        $query = "SELECT * FROM usermng WHERE `User`='$User'";
    }
}

$result  = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_array($result)) {
        $output[] = $row;
    }
    echo json_encode($output);
} else {
    echo null;
}
CloseCon($conn);

