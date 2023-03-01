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
$update_id=$_POST['usereditid'];
$userrolle=$_POST['rolle'];
if($update_id == "1") {
    mysqli_close($dbcon);	
	echo"<script>alert('Der Admin kann nicht geändert werden.')</script>";
    echo "<script>window.open('verwaltung.php','_self')</script>";	
}

else
	
{	
$update_query="UPDATE user SET user_type='$userrolle' WHERE id='$update_id'";   //delete query  
$run=mysqli_query($dbcon,$update_query);  
if($run)  
{  
    mysqli_close($dbcon);
    header('location:verwaltung.php');

} }
?> 