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
$delete_id_user=$_GET['del_auftragsart'];
	
$delete_query="delete  from auftragsart WHERE id='$delete_id_user'";   //delete query  
$run=mysqli_query($dbcon,$delete_query);  
if($run)  
{  
    mysqli_close($dbcon);
    header('location:verwaltung.php #auftraglist'); 
 
} 
?> 