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
if(isset($_POST['username']))  
{  
    $Userhinz=$_POST['username']; //here getting result from the post array after submitting the form.
    $passwort_hash=md5($_POST['passw']);
    $Userrolle=$_POST['rolle'];
    
//here query check weather if user already registered so can't register again.  
    $check_user_query="select * from user WHERE user_name='$Userhinz'";  
    $run_query=mysqli_query($dbcon,$check_user_query);  
  
    if(mysqli_num_rows($run_query)>0)  
    {
        mysqli_close($dbcon);  
        echo "<script>alert('Der User --- $Userhinz ---  wurde schon vergeben.')</script>";
        echo "<script>window.open('verwaltung.php','_self')</script>";   
        exit();
    }  
//insert the user into the database.  
    $insert_user="insert into user (user_name,user_pass,user_type) VALUE ('$Userhinz','$passwort_hash','$Userrolle')"; 
    if(mysqli_query($dbcon,$insert_user))  
    {
        mysqli_close($dbcon);
        header('location:verwaltung.php');  
		//echo "<script>window.open('verwaltung.php','_self')</script>"; 
    }  
}  
  
?>  