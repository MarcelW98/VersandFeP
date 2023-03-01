<?php  
session_start();//session starts here  
  
?>  
  
<html>  
<head lang="en">  
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="view/media/favicon.ico">  
    <link type="text/css" rel="stylesheet" href="css\bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/sticky-footer-navbar.css">
	<link rel="stylesheet" href="css/rb_design.css">
	<script src="js/jquery.min.js"></script>
    <script src="js/angular.min.js"></script>
    <title>Login Paketzentrum@FeP</title>  
</head>   

<body class="bg">

<header class="bg-light">
<!-- This is the header -->  
	<img src="view/media/colorbar.png" alt="colorbar" class="img-fluid" style="width:120%"/> 
      <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
		<a class="navbar-brand align-top">
            <img src="view/media/BoschLogoNavColored.png" width="180" height="40" class="d-inline-block rounded" alt="Bosch Icon"/>
            Versand Werk Feuerbach</a>
      </nav>
</header> 
<br /> 
 
<div class="container-fluid col-md-6 bg-white rounded text-center">   
  <a><img src="view/media/Logo_groß.png" style="width:620px;height:150px;" class="d-inline-block rounded img-fluid" alt="LOGO"/><img src="view/media/Paketzentrum.png" style="width:500px;height:55px;" class=" img-fluid" alt="LOGO"/></a>
  <br />
  <br />
 </div> 
<br /> 
<br />

<main role="main" class="container text-center"> 
<div class="container-fluid">  
    <div class="row">  
        <div class="container col-md-4 bg-light rounded">  
            <div class="login-panel panel panel-success">  
                <div class="panel-heading">  
                    <h3 class="panel-title">Benutzer Login</h3>  
                </div>  
                <div class="panel-body">  
                    <form role="form" method="post" action="login.php">  
                        <fieldset>  
                            <div class="form-group"  >  
                                <input class="form-control" placeholder="Benutzer" name="benutzer" id="benutzer" type="text" autofocus required>  
                            </div>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Password" name="pass" id="pass" type="password" autofocus required>  
                            </div>  
  
  
                                <input class="btn rb-button rb-button--primary btn-block" type="submit" value="login" id="login" name="login" >  
  
                            <!-- Change this to a button or input when using this as a form   btn btn-lg btn-success btn-block -->  
                          <!--  <a href="index.html" class="btn btn-lg btn-success btn-block">Login</a> -->  
                        </fieldset>  
                    </form>  
                </div>  
            </div>  
        </div>  
    </div>  
</div>  
</main>

<?php
include("function/footer.php")  
?>

</body>  
  
</html>  

 
<?php  
  
include("database/db_conection.php");  
  
if(isset($_POST['login']))  
{  
    $user_benutzer=$_POST['benutzer'];  
    $user_pass=$_POST['pass'];
	$hashed_password = md5($_POST["pass"]);
	
    $check_user="select * from user WHERE user_name='$user_benutzer' AND user_pass='$hashed_password'";	
    $results=mysqli_query($dbcon,$check_user); 
	
	if(mysqli_num_rows($results)== 1) {
		
		$logged_in_user = mysqli_fetch_assoc($results);
		
	if ($logged_in_user['user_type'] == 'admin') {
		
        $_SESSION['admin']=$_POST['benutzer'];
        $_SESSION['last_time'] = time();
		echo "<script>window.open('paketzentrum.php','_self')</script>";
        
    } else
     
    if ($logged_in_user['user_type'] == 'schichtfuehrer') {
		
            $_SESSION['schichtfuehrer']=$_POST['benutzer'];
            $_SESSION['last_time'] = time();
            echo "<script>window.open('paketzentrum.php','_self')</script>";
                    
    } else
    
    if ($logged_in_user['user_type'] == 'benutzer') {
		
            $_SESSION['benutzer']=$_POST['benutzer'];
            echo "<script>window.open('paketzentrum.php','_self')</script>";
                    
    } else
    
    if ($logged_in_user['user_type'] == 'buero') {
		
        $_SESSION['buero']=$_POST['benutzer'];
        echo "<script>window.open('paketzentrum.php','_self')</script>";
                
} 
	
	
	} else {
		
		echo "<script>alert('Benutzer oder Passwort Falsch!')</script>";
		
	}
	
}

mysqli_close($dbcon);
?>

