<?php  
session_start();

    if(isset($_SESSION['admin'])) {
    $Schicht = 0;
    $buero = 0;     
    $Admin = 1;
    $inactive = 600;
    $session_life = time() - $_SESSION['last_time']; 
    if($session_life > $inactive){   
      header("Location: login.php"); //zurück zur login Seite wenn keine Anmeldung  
    }   
} else {
    header("Location: login.php"); //zurück zur login Seite wenn keine Anmeldung  
}
$_SESSION['last_time'] = time();
?>

<?php 
include("database/db_conection.php"); 	
$delete_id_gesch=$_GET['del_gb'];
	
$delete_query="delete  from gb WHERE id='$delete_id_gesch'";   //delete query  
$run=mysqli_query($dbcon,$delete_query);  
if($run)  
{  
    header('location:verwaltung.php #gblist'); 
} 
?> 