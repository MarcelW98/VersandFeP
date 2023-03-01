<?php  
session_start();  
  
if(isset($_SESSION['benutzer']))
{  
    $Schicht = 0;
    $buero = 0; 
    $Admin = 0;    
} else

if(isset($_SESSION['buero']))
{  
    $Schicht = 0;
    $Admin = 0;
    $buero = 1;    
} else

if(isset($_SESSION['schichtfuehrer'])) {
    $Schicht = 1;
    $buero = 0; 
    $Admin = 0;
    $inactive = 600;
    $session_life = time() - $_SESSION['last_time']; 
    if($session_life > $inactive){   
      header("Location: login.php"); //zurück zur login Seite wenn keine Anmeldung  
    }  
} else

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
  
<head lang="en">  
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="view/media/favicon.ico">  
    <link type="text/css" rel="stylesheet" href="css\bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/sticky-footer-navbar.css">
	<link rel="stylesheet" href="css/rb_design.css">
	<script src="js/angular.js"></script>  
	<script src="js/jquery.min.js"></script>
    <title>Verpacken Paketzentrum</title>  
</head>   

<body class="bg">

<header class="bg-light fixed-top">
<!-- Header -->  
	<img src="view/media/colorbar.png" alt="colorbar" class="img-fluid" style="width: 100%"/> 
      <nav class="navbar navbar-light bg-faded">
		<a class="navbar-brand align-top">
            <img src="view/media/BoschLogoNavColored.png" width="180" height="40" class="d-inline-block" alt="Bosch Icon"/>
            Versand Werk Feuerbach &nbsp &nbsp &nbsp &nbsp <button class="align-self-end btn rb-button rb-button--primary" onclick="location.href = 'Paketzentrum.php'">zurück zur Übersicht</button></a>
<?php 
if($Schicht == 1)
{  
    echo "<a><center><strong>Sie sind als Schichtführer eingeloggt</strong><br>(nach 10 Minuten Inaktivität werden Sie automatisch abgemeldet.)</center></a>";    
} 

if($Admin == 1)
{
echo "<a><center><strong>Sie sind als Administrator eingeloggt</strong><br>(nach 10 Minuten Inaktivität werden Sie automatisch abgemeldet.)</center></a>";
echo "<a href='verwaltung.php'><button class='btn btn-success rb-button-sm'>Verwaltung</button></a>";    
} 
?>
<button type="button" class="btn btn-danger rb-button-sm" onclick="location.href = 'Logout.php'">Abmelden</button> 
      </nav>
</header> 
<br />
<br />
<br />
<br />
<div class="bg-white container-fluid col-md-6 bg-light rounded text-center">   
  <a><img src="view/media/Logo_groß.png" width="620px" height="150px" class="d-inline-block rounded img-fluid" alt="LOGO"/><h1>Analyse</h1></a>
  <br />
 </div> 
<br />
<main>
 <div class="container-fluid col-md-12 border rounded" style="width:700px; background-color: #efeff0;">
  
  
    <form>
	
<!-- Barcode Scan -->
     <div class="form-group col-md-12 center-block text-center">
     <br />
      <label><h2><strong><span class="text-danger">This site is under construction</span></strong></h2></label>
     </div>    
    </form>
   </div>
  </div>
</main>


  
  
<?php
include("function/footer.php")  
?>

</body>    
</html>


