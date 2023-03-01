<?php

function OpenCon()
{
    $dbhost = "127.0.0.1";
    $dbuser = "root";
    $dbpass = "";
    $db = "digitaleslieferboard";

    $conn = mysqli_connect($dbhost, $dbuser, $dbpass, $db) or die ("Connect failed: %s\n" . $conn -> error);
    mysqli_set_charset($conn,"utf8");
    return $conn;

}

function CloseCon($conn)
{
$conn -> close();
}

