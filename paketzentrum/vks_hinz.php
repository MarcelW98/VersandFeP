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
if(isset($_POST['VKS_Nummer']))  
{  
    $VKS_hinz=$_POST['VKS_Nummer'];
    $VKS_Name=$_POST['VKS_Name'];  
    

    $check_vks_query="select * FROM vks WHERE VKS_Nummer='$VKS_hinz'";  
    $run_query=mysqli_query($dbcon,$check_vks_query);  
  
    if(mysqli_num_rows($run_query)>0)  
    {
        mysqli_close($dbcon);  
        echo "<script>alert('Die VKS Nummer --- $VKS_hinz ---  wurde schon vergeben.')</script>";
        echo "<script>window.open('verwaltung.php','_self')</script>";   
        exit();  
    }  
//insert the user into the database.
    $insert_vks="insert into vks (VKS_Nummer, VKS_Name) VALUE ('$VKS_hinz','$VKS_Name')";  
    if(mysqli_query($dbcon,$insert_vks))  
    {  
        mysqli_close($dbcon);
        header('location:verwaltung.php #vkslist'); 
    }  
}  
  
?>  