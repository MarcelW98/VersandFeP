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
if(isset($_POST['Hinweis']))  
{  
    $Hinweis_hinz=$_POST['Hinweis'];//here getting result from the post array after submitting the form.  
    
//here query check weather if user already registered so can't register again.  
    $check_Hinweis_query="select * FROM hinweis WHERE Hinweise='$Hinweis_hinz'";  
    $run_query=mysqli_query($dbcon,$check_Hinweis_query);  
  
    if(mysqli_num_rows($run_query)>0)  
    {
        mysqli_close($dbcon);  
        echo "<script>alert('Der Hinweis --- $Hinweis_hinz ---  wurde schon vergeben.')</script>";
        echo "<script>window.open('verwaltung.php','_self')</script>";   
        exit();  
    }  
//insert the user into the database.
    $insert_Hinweis="insert into hinweis (Hinweise) VALUE ('$Hinweis_hinz')";  
    if(mysqli_query($dbcon,$insert_Hinweis))  
    {  
        mysqli_close($dbcon);
        header('location:verwaltung.php #hinweislist'); 
    }  
}  
  
?>  