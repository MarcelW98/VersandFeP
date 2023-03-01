<?php 
// require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/auth/authguard.php");

// AuthGuard::getInstance()->protect(UserType::ADMIN, UserType::SCHICHT, UserType::BUERO, UserType::WERKSTATT, UserType::MONITOR);  
 
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
    // if($session_life > $inactive){   
    //   header("Location: login.php"); //zurück zur login Seite wenn keine Anmeldung  
    // }  
} else

    if(isset($_SESSION['admin'])) {
    $Schicht = 0;
    $buero = 0;     
    $Admin = 1;
    $inactive = 600;
    $session_life = time() - $_SESSION['last_time']; 
    // if($session_life > $inactive){   
    //   header("Location: login.php"); //zurück zur login Seite wenn keine Anmeldung  
    // }   
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
	  <script src="js/jquery.min.js"></script>
    <script src="js/angular.min.js"></script>	
    <title>Paketzentrum@FeP</title>  
</head>   

<body class="bg" method="post">

<header class="bg-light fixed-top">
<!-- Das ist der Header -->  
	<img src="view/media/colorbar.png" alt="colorbar" class="img-fluid" style="width:100%"/> 
      <nav class="navbar navbar-light bg-faded">
		<a class="navbar-brand align-top">
            <img src="view/media/BoschLogoNavColored.png" width="180" height="40" class="d-inline-block rounded" alt="Bosch Icon"/>
            Versand Werk Feuerbach</a> 
<?php 
if($Schicht == 1)
{  
  echo "<a><center><strong>Sie sind als Schichtführer eingeloggt</strong></center></a>";  
} 

if($Admin == 1)
{
  echo "<a style='font-size:0.8vw;'><center><strong>Sie sind als Administrator eingeloggt</strong></center></a>";       
  echo "<a href='verwaltung.php'><button class='btn btn-success rb-button-sm'>Verwaltung</button></a>";    
} 
?>
            <?php if (!isset($_SESSION['user_role'])){  ?>
            <button type="button" class="btn btn-danger rb-button-sm" onclick="location.href = 'logout.php'">Abmelden</button>
            <?php } ?>
      </nav>
</header> 
<br />
<br />
<br />
<br />
<div class="container-fluid col-md-6 bg-white rounded text-center">   
  <a><img src="view/media/Logo_groß.png" style="width:620px;height:120px;" class=" img-fluid" alt="LOGO"/><img src="view/media/Paketzentrum.png" style="width:500px;height:55px;" class=" img-fluid" alt="LOGO"/></a>
  <br />
  <br />
 </div> 
<br />


<main>
<div class="container-fluid col-xl-11"> 
<div class="card-deck">
  <div class="card border-secondary mb-4">
  	<h4 class="card-title text-center">Wareneingang</h4>
    <img class="card-img-top center img-fluid" src="view/media/Warenanahme.png" style="width:228px;height:128px;" alt="Card image cap">
    <div class="card-body d-flex flex-column">
	  <button class="btn rb-button-lg rb-button--primary btn-block" onclick="location.href = 'wareneingang.php'">Start</button>
    </div>
  </div>
  <div class="card mb-4">
  	<h4 class="card-title text-center">Verpackung</h4>
  	<img class="card-img-top center img-fluid" src="view/media/verpacken.png" style="width:180px;height:128px;" alt="Card image cap">
	  <div class="card-body d-flex flex-column">
    <button class="align-self-end btn rb-button-lg rb-button--primary btn-block" onclick="location.href = 'verpacken.php'">Start</button>
    </div>
  </div>
  <div class="w-100 d-none d-sm-block d-md-none"></div>
  <div class="card mb-4">
  	<h4 class="card-title text-center">Bereitstellung</h4>
  	<img class="card-img-top center img-fluid" src="view/media/bereitstellung.png" style="width:228px;height:128px;" alt="Card image cap">
    <div class="card-body d-flex flex-column">
    <button class="align-self-end btn rb-button-lg rb-button--primary btn-block" onclick="location.href = 'bereitstellung.php'" role="button">Start</button>
    </div>
	</div>
  <div class="w-100 d-none d-md-block d-lg-none"></div>
  <div class="card mb-4">
  	<h4 class="card-title text-center">Transportpapiere</h4>
  	<img class="card-img-top center img-fluid" src="view/media/transportpapiere.png" style="width:235px;height:128px;" alt="Card image cap">
	  <div class="card-body d-flex flex-column">
    <button class="align-self-end btn rb-button-lg rb-button--primary btn-block" onclick="location.href = 'transportpapiere.php'" role="button">Start</button>
    </div>
	</div>
  <div class="w-100 d-none d-sm-block d-md-none"></div>
  <div class="w-100 d-none d-lg-block d-xl-none"></div> 
    <div class="card mb-4">
  	<h4 class="card-title text-center">Versand</h4>
  	<img class="card-img-top center img-fluid" src="view/media/versand.png" style="width:228px;height:128px;" alt="Card image cap">
	  <div class="card-body d-flex flex-column">
    <button class="align-self-end btn rb-button-lg rb-button--primary btn-block" onclick="location.href = 'versand.php'" role="button">Start</button>
    </div>
  </div>
  <div class="w-100 d-none d-xl-block"></div>
  <div class="card mb-4">
  	<h4 class="card-title text-center">Klärfälle</h4>
  	<img class="card-img-top center img-fluid" src="view/media/klaerung.png" style="width:228px;height:128px;" alt="Card image cap">
    <div class="card-body d-flex flex-column">
		<button class="align-self-end btn rb-button-lg rb-button--primary btn-block" onclick="location.href = 'klaerung.php'" role="button">Start</button>
    </div>
  </div>
  <div class="w-100 d-none d-sm-block d-md-none"></div>
  <div class="w-100 d-none d-md-block d-lg-none"></div>
  <div class="card mb-4">
  	<h4 class="card-title text-center">Annahmeverweigerung</h4>
  	<img class="card-img-top center img-fluid" src="view/media/annahme.png" style="width:150px;height:128px;" alt="Card image cap">
    <div class="card-body d-flex flex-column">
		<button class="align-self-end btn rb-button-lg rb-button--primary btn-block" onclick="location.href = 'annahmeverweigerung.php'" role="button">Start</button>
    </div>
  </div>
  <div class="card mb-4">
  	<h4 class="card-title text-center">Stornierung</h4>
  	<img class="card-img-top center img-fluid" src="view/media/storno.png" style="width:150px;height:128px;" alt="Card image cap">
    <div class="card-body d-flex flex-column">
		<button class="align-self-end btn rb-button-lg rb-button--primary btn-block" onclick="location.href = 'stornieren.php'" role="button">Start</button>
    </div>
  </div>
  <div class="w-100 d-none d-sm-block d-md-none"></div>
  <div class="w-100 d-none d-lg-block d-xl-none"></div>
  <div class="card mb-4">
  	<h4 class="card-title text-center">Suche/Tracking</h4>
  	<img class="card-img-top center img-fluid" src="view/media/suche.png" style="width:228px;height:128px;" alt="Card image cap">
    <div class="card-body d-flex flex-column">
		<button class="align-self-end btn rb-button-lg rb-button--primary btn-block" onclick="location.href = 'index.php'" role="button">Start</button>
    </div>
  </div>
  <div class="card mb-4">
  	<h4 class="card-title text-center">Analyse</h4>
  	<img class="card-img-top center img-fluid" src="view/media/analyse.png" style="width:228px;height:128px;" alt="Card image cap">
    <div class="card-body d-flex flex-column">
		<button class="align-self-end btn rb-button-lg rb-button--primary btn-block" onclick="window.open('https://fe-pt7.de.bosch.com/#/site/PS-FeP/workbooks/13113/views');" role="button">Start</button>
    </div>
  </div>
</div>
</div>
<br />

</main> 
  
<?php
include("function/footer.php")  
?> 

</body>    
  
</html>