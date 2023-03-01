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
  
include("database/db_conection.php");//make connection here  
if(isset($_POST['Auftraga']))  
{  
    $Auftragsahinz=$_POST['Auftraga'];//here getting result from the post array after submitting the form.  
    
//here query check weather if user already registered so can't register again.  
    $check_Auftragsa_query="select * from auftragsart WHERE Auftragsart='$Auftragsahinz'";  
    $run_query=mysqli_query($dbcon,$check_Auftragsa_query);  
  
    if(mysqli_num_rows($run_query)>0)  
    {  
echo "<script>alert('Die Auftragsart --- $Auftragsahinz ---  wurde schon vergeben.')</script>";
echo "<script>window.open('verwaltung.php','_self')</script>";   
exit();  
    }  
//insert the user into the database.
    $insert_Auftragsart="insert into auftragsart (Auftragsart) VALUE ('$Auftragsahinz')";  
    if(mysqli_query($dbcon,$insert_Auftragsart))  
    {  
        header('location:verwaltung.php #auftraglist'); 
} } 
  
?>  