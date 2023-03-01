<?php  
session_start();

    if(isset($_SESSION['admin'])) {
    $Schicht = 0;
    $buero = 0;     
    $Admin = 1;
    $inactive = 600;
    $session_life = time() - $_SESSION['last_time']; 
    if($session_life > $inactive){   
      header("Location: login.php"); 
    }   
} else {
    header("Location: login.php"); 
}
$_SESSION['last_time'] = time();
?>  
 
<?php 
include("database/db_conection.php");  
$vks_id=$_POST['vkseditid'];
$VKS_Name=$_POST['VKS_Name'];


$check_vks_query="select * FROM vks WHERE VKS_Name='$VKS_Name'";  
$run_query=mysqli_query($dbcon,$check_vks_query);  

if(mysqli_num_rows($run_query)>0)  
{
    mysqli_close($dbcon);  
    echo "<script>alert('Die VKS Nummer --- $VKS_Name ---  wurde schon vergeben.')</script>";
    echo "<script>window.open('verwaltung.php','_self')</script>";   
    exit();  
}

//update query 
$update_query="UPDATE vks SET VKS_Name='$VKS_Name'  WHERE id='$vks_id'";    
$run=mysqli_query($dbcon,$update_query);  
if($run)  
{  
    mysqli_close($dbcon);
    header('location:verwaltung.php #vkslist'); 
}
?> 