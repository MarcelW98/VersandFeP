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
$delete_id=$_GET['del_user'];
if($delete_id == "1") {
	
	echo"<script>alert('Der Admin kann nicht gelöscht werden.')</script>";
    echo "<script>window.open('verwaltung.php','_self')</script>";	
}

else
	
{	
$delete_query="delete  from user WHERE id='$delete_id'";   //delete query  
$run=mysqli_query($dbcon,$delete_query);  
if($run)  
{  
//javascript function to open in the same window
header('location:verwaltung.php');    
    //echo "<script>window.open('verwaltung.php?deleted=user has been deleted','_self')</script>";  
} }
?> 