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
$vks_id=$_POST['vkseditid'];
$VKS_Name=$_POST['VKS_Name'];

//here query check weather if user already registered so can't register again.  
$check_vks_query="select * FROM vks WHERE VKS_Name='$VKS_Name'";  
$run_query=mysqli_query($dbcon,$check_vks_query);  

if(mysqli_num_rows($run_query)>0)  
{  
echo "<script>alert('Die VKS Nummer --- $VKS_Name ---  wurde schon vergeben.')</script>";
echo "<script>window.open('verwaltung.php','_self')</script>";   
exit();  
}

$update_query="UPDATE vks SET VKS_Name='$VKS_Name'  WHERE id='$vks_id'";   //delete query  
$run=mysqli_query($dbcon,$update_query);  
if($run)  
{  

    header('location:verwaltung.php #vkslist'); 
}
?> 