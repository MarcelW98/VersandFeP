<?php  
session_start();  
  
if(isset($_SESSION['benutzer']))
{  
    $Schicht = 0;
    $Admin = 0;
    $buero = 0;    
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
} else {
    header("Location: login.php"); //zurück zur login Seite wenn keine Anmeldung  
}
$_SESSION['last_time'] = time();
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
  <title>Tracking@FeP</title>  
</head>   

<body class="bg">

<header class="bg-light fixed-top">  
	<img src="view/media/colorbar.png" alt="colorbar" class="img-fluid" style="width:120%"/> 
      <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
		    <a class="navbar-brand align-top">
          <img src="view/media/BoschLogoNavColored.png" width="180" height="40" class="d-inline-block rounded" alt="Bosch Icon"/>
          Versand Werk Feuerbach &nbsp &nbsp &nbsp &nbsp <button class="align-self-end btn rb-button rb-button--primary" onclick="location.href = 'paketzentrum.php'">zurück zur Übersicht</button></a>
<?php 
if($Schicht == 1)
{  
    echo "<a style='font-size:0.8vw;'><center><strong>Sie sind als Schichtführer eingeloggt</strong></center></a>";    
} 

if($Admin == 1)
{
    echo "<a style='font-size:0.8vw;'><center><strong>Sie sind als Administrator eingeloggt</strong></center></a>"; 
    echo "<a href='verwaltung.php'><button class='btn btn-success rb-button-sm'>Verwaltung</button></a>";    
} 
?>    
 <?php if (!isset($_SESSION['user_role'])){  ?>    
        <button type="button" class="btn btn-danger rb-button-sm" onclick="location.href = 'Logout.php'">Abmelden</button>
        <?php } ?>
      </nav>
</header> 
<br />
<br />
<br />
<br />
<br />
 
<main role="main" class="container text-center"> 
<div class="container-fluid col-md-12 text-center">  
    <div class="row">  
        <div class="container col-md-12 bg-white rounded text-center">  
            <div class="login-panel panel panel-success">  
                <div class="panel-heading">
				          <a><img src="view/media/Logo_groß.png" width="600" height="300" class="d-inline-block rounded img-fluid" alt="LOGO"/><h3>Suche / Tracking</h3></a>				
                </div>  
                <br />
                    <form method="Post">
					            <h5>Bitte Referenznummer zum Suchen eingeben oder scannen!</h5>
                      <br />
                      <br />                
                        <div class="row">
                          <div class="col-2">
                          </div>
                            <div class="col-8">
                            <h4><input type="text" class="form-control" style="text-align:center" name="suchbegriff" autofocus required></h4> 
                            </div>
                              <div class="col">
                                <input type="submit" name="search" class="rb-button rb-button--primary" value="suchen">
                              </div>
                        </div>                   					
                        <br />
                      </form>		               
            </div>  
        </div>  
    </div>  
</div>

</main>
<br />  
<?php

if(isset($_POST['search']))  
{
				
$pdo = new PDO('mysql:host=127.0.0.1;dbname=paketzentrum;charset=utf8', 'root', '');


$searchfor = $_POST['suchbegriff'];

$statement = $pdo->prepare("SELECT * FROM versendungen WHERE referenznr LIKE :referenznr OR Lieferschein = :Lieferschein OR Trackingnummer = :Trackingnummer LIMIT 30");

if($statement->execute(array('referenznr' => "%$searchfor%", 'Lieferschein' => "$searchfor", 'Trackingnummer' => "$searchfor" ))) {

$anzahl_daten = $statement->rowCount(); 

if($anzahl_daten == 0) {
  echo '<div class="container-fluid col-md-4 bg-light rounded text-center">';
  echo "<br>";
  echo "<img src='view/media/warning-red.svg' width='50' height='50' alt=''><h5 style='color:red; font-weight: bold;'>Es wurden keine Daten gefunden</h5><br><br> ";
  echo '<br /> </div>';
} else { 

while($row = $statement->fetch())
{

echo '<br />';

$ID = $row['ID'];
$Auftrag = $row['referenznr'];
$Storno = $row['Status_Storno'];
$Klaerung = $row['Status_Klaerung'];

//Wareneingangs Info
$ZeitW = $row['Zeit_Wareneingang'];
$DatumW = $row['Datum_Wareneingang'];
$AuftragsartW = $row['Auftragsart_Wareneingang'];
$GB = $row['GB_Wareneingang'];
$PrioW = $row['Prioritaet_Wareneingang'];
$HinweisW = $row['Hinweis_Wareneingang'];
$BearbeiterW = $row['Bearbeiter_VKS_Wareneingang'];

//Verpacken Info
$ZeitV = $row['Zeit_verpacken'];
$DatumV = $row['Datum_verpacken'];
$BearbeiterV = $row['Bearbeiter_VKS_Verpacken'];
$Abmessung = $row['Abmessung_cm'];
$Gewicht = $row['Gewicht_kg'];

//Bereitstellen Info
$ZeitB = $row['Zeit_Bereitstellung'];
$DatumB = $row['Datum_Bereitstellung'];
$LieferscheinB = $row['Lieferschein'];
$Weitere_BearbeitungB = $row['Weitere_Bearbeitung'];
$LhinweisB = $row['Laenderhinweis'];
$BearbeiterB = $row['Bearbeiter_VKS_Bereitstellung'];

//Transportpapiere Info
$ZeitT = $row['Zeit_Transportpapiere'];
$DatumT = $row['Datum_Transportpapiere'];
$DienstleisterT = $row['Paketdienstleister'];
$TrackingT = $row['Trackingnummer'];
$BearbeiterT = $row['Bearbeiter_VKS_Transportpapiere'];

//Versendung Info
$ZeitVS = $row['Zeit_Versendung'];
$DatumVS = $row['Datum_Versendung'];
$BearbeiterVS = $row['Bearbeiter_VKS_Versendung'];

//KlärungInfo
$ZeitKL = $row['Zeit_Klaerung'];
$DatumKL = $row['Datum_Klaerung'];
$Klaerungsgrund = $row['Grund_Klaerung'];
$Bearbeiterklaerung = $row['Bearbeiter_VKS_Klaerung'];

//Storno Info
$ZeitST = $row['Zeit_Storno'];
$DatumST = $row['Datum_Storno'];
$Stornogrund = $row['Grund_Storno'];
$Bearbeiterstorno = $row['Barbeiter_VKS_Storno'];

$dateklaerung = $pdo->prepare("SELECT TIMESTAMPDIFF(SECOND, STR_TO_DATE(CONCAT(Datum_Klaerung, Zeit_Klaerung), '%d.%m.%Y%H:%i:%s'), STR_TO_DATE(CONCAT(Datum_Wareneingang, Zeit_Wareneingang), '%d.%m.%Y%H:%i:%s')) AS timediffw, TIMESTAMPDIFF(SECOND, STR_TO_DATE(CONCAT(Datum_Klaerung, Zeit_Klaerung), '%d.%m.%Y%H:%i:%s'), STR_TO_DATE(CONCAT(Datum_verpacken, Zeit_verpacken), '%d.%m.%Y%H:%i:%s')) AS timediffv, TIMESTAMPDIFF(SECOND, STR_TO_DATE(CONCAT(Datum_Klaerung, Zeit_Klaerung), '%d.%m.%Y%H:%i:%s'), STR_TO_DATE(CONCAT(Datum_Bereitstellung, Zeit_Bereitstellung), '%d.%m.%Y%H:%i:%s')) AS timediffb, TIMESTAMPDIFF(SECOND, STR_TO_DATE(CONCAT(Datum_Klaerung, Zeit_Klaerung), '%d.%m.%Y%H:%i:%s'), STR_TO_DATE(CONCAT(Datum_Transportpapiere, Zeit_Transportpapiere), '%d.%m.%Y%H:%i:%s')) AS timedifft, TIMESTAMPDIFF(SECOND, STR_TO_DATE(CONCAT(Datum_Klaerung, Zeit_Klaerung), '%d.%m.%Y%H:%i:%s'), STR_TO_DATE(CONCAT(Datum_Versendung, Zeit_Versendung), '%d.%m.%Y%H:%i:%s')) AS timediffversa FROM versendungen WHERE Datum_Klaerung NOT LIKE '' AND Status_Klaerung NOT LIKE '1' AND referenznr = :referenznr");
$dateklaerung->execute(array('referenznr' => "$Auftrag"));
$result = $dateklaerung->fetch(PDO::FETCH_ASSOC);

$smallestPosNumArr = [];
$genaueklaerung = "";

if(!empty($result)) {
  foreach($result as $key => $value) {
    if($value > 0) {
        array_push($smallestPosNumArr, $value);
    }
  }
  
  if(!empty($smallestPosNumArr)) {
    if(!empty($smallestPosNumArr[0])) {
      $sekunden = $smallestPosNumArr[0];
      $genaueklaerung = sec_to_time($sekunden);
    }
  }
}

//Suchergebnis anzeigen
echo '<div class="container-fluid bg-light rounded text-center">';
echo "<h4>Suchergebnis</h5><br />";
echo "<h5>Referenznummer</h5>";
echo "<h5><input name='Auftrag' type='text' class='textfield text-center id='Auftrag' value='$Auftrag' readonly /><br></h5> ";
if($Storno == 1) {
    echo "<h5><img src='view/media/warning-red.svg' width='50' height='50' alt=''><b style='color:red'>Der Auftrag wurde am:  $DatumST  /  $ZeitST storniert. &nbsp - &nbsp Grund: $Stornogrund &nbsp - &nbsp Bearbeiter: $Bearbeiterstorno";
    echo"</h5></b>";
  }

  if($Klaerung == 1) {
    echo "<h5><img src='view/media/warning-yellow.svg' width='50' height='50' alt=''><b class='bg-warning'>&nbsp &nbsp Der Auftrag ist seit:  $DatumKL  /  $ZeitKL in Klärung. &nbsp - &nbsp Grund: $Klaerungsgrund &nbsp - &nbsp Bearbeiter: $Bearbeiterklaerung &nbsp &nbsp";
    echo"</h5></b>";
  }
 
    if(!empty($ZeitKL) && empty($Klaerung)) {
      echo "<h5><img src='view/media/warning-yellow.svg' width='50' height='50' alt=''><b class='bg-warning'>&nbsp &nbsp Der Auftrag war am: $DatumKL  /  $ZeitKL  für $genaueklaerung in Klärung &nbsp - &nbsp Grund: $Klaerungsgrund &nbsp &nbsp";
      echo"</h5></b>";
    }


echo"<br>";
echo '<div class="row  text-center">';
echo '<div class="col-1">';
echo '</div>';
echo '<div class="col-2 border">';
echo '<img src="view/media/green.svg" width="50" height="50" alt="">'; 	
echo '<h5><img src="view/media/Warenanahme.png" width="40" height="30"alt="">&nbsp Warenannahme<h5>';
echo '<hr width=60%>';
echo "<h5> " . $DatumW ." / " . $ZeitW . "<br><br>";
echo '<div class="text-left">';
echo "<u>Auftragsart:</u> $AuftragsartW<br><br>";
if($AuftragsartW == "WorkOn") {
    echo "<a href='https://rb-wam.bosch.com/workon01/workflow01/browse/" . $Auftrag."'target='_blank' rel='noopener'><button class='rb-button rb-button--primary'>WorkOn Link</button></a><br><br>";
}
echo "<u>Geschäftsbereich:</u> $GB<br><br>";
echo "<u>Hinweis:</u> $HinweisW<br><br>";
echo "<u>Priorität:</u> $PrioW<br><br></h5>";
//echo "<u>Bearbeiter:</u> $BearbeiterW<br><br></h5>";
echo '</div>';

if($DatumV == 0) {
  echo '<div class="col-2 border">';
  echo '<img src="view/media/red.svg" width="50" height="50" alt="">';	
  echo '<h5><img src="view/media/verpacken.png" width="40" height="30"alt="">&nbsp Ware verpacken</h5><h6>(Ausstehend)<br><br></h5>';
  echo '</div>';	
} else {
    echo '<div class="col-2 border">';
    echo '<img src="view/media/green.svg" width="50" height="50" alt="">';
    echo '<h5><img src="view/media/verpacken.png" width="40" height="30"alt="">&nbsp Ware verpackt<h5>';	
    echo '<hr width=60%>';
    echo "<h5> " . $DatumV ." / " . $ZeitV . "<br><br>";
    echo '<div class="text-left">';
    echo "<u>Größe:</u> $Abmessung &nbsp cm<br><br>";
    echo "<u>Gewicht:</u> $Gewicht &nbsp kg<br><br>";
    //echo "<u>Bearbeiter:</u> $BearbeiterV<br><br>";
    echo '</div></div>';
    }

if($DatumB == 0) {
  echo '<div class="col-2 border">';
  echo '<img src="view/media/red.svg" width="50" height="50" alt="">';	
  echo '<h5><img src="view/media/bereitstellung.png" width="40" height="30"alt="">&nbsp Ware bereistellen</h5><h6>(Ausstehend)<br><br></h5>';
  echo '</div>';	
} else {
    echo '<div class="col-2 border">';
    echo '<img src="view/media/green.svg" width="50" height="50" alt="">';
    echo '<h5><img src="view/media/bereitstellung.png" width="40" height="30"alt="">&nbsp Ware bereitgestellt<h5>';	
    echo '<hr width=60%>';
    echo "<h5> " . $DatumB ." / " . $ZeitB . "<br><br>";
    echo '<div class="text-left">';
    echo "<u>Lieferschein:</u> $LieferscheinB<br><br>";
    echo "<u>Weitere Bearb.:</u> $Weitere_BearbeitungB<br><br>";
    echo "<u>Länderhinweis:</u> $LhinweisB<br><br>";
    //echo "<u>Bearbeiter:</u> $BearbeiterB<br><br>";
    echo '</div></div>';
    }

if($DatumT == 0) {
  echo '<div class="col-2 border">';
  echo '<img src="view/media/red.svg" width="50" height="50" alt="">';	
  echo '<h5><img src="view/media/transportpapiere.png" width="40" height="30"alt="">&nbsp Transportpapiere</h5><h6>(Ausstehend)<br><br></h5>';
  echo '</div>';	
} else {
    echo '<div class="col-2 border">';
    echo '<img src="view/media/green.svg" width="50" height="50" alt="">';
    echo '<h5><img src="view/media/transportpapiere.png" width="40" height="30"alt="">&nbsp Transportpapiere<h5>';	
    echo '<hr width=60%>';
    echo "<h5> " . $DatumT ." / " . $ZeitT . "<br><br>";
    echo '<div class="text-left">';
    echo "<u>Dienstleister:</u> $DienstleisterT<br><br>";

      if($DienstleisterT == "TNT") {
        echo "<u>Tracking:</u> $TrackingT<br><br>";
        echo "<a href='https://www.tnt.com/express/de_de/site/home/applications/tracking.html?searchType=con&cons=" . $TrackingT ."'target='_blank' rel='noopener'><button class='rb-button rb-button--primary'>Tracking Link</button></a><br><br>";
      }
        if($DienstleisterT == "UPS") {
          echo "<u>Tracking:</u> $TrackingT<br><br>";
          echo "<a href='https://www.ups.com/track?loc=de_DE&tracknum=" . $TrackingT ."'target='_blank' rel='noopener'><button class='rb-button rb-button--primary'>Tracking Link</button></a><br><br>";
        }
          if($DienstleisterT == "DHL Express") {
            echo "<u>Tracking:</u> $TrackingT<br><br>";
            echo "<a href='http://www.dhl.com/content/g0/en/express/tracking.shtml?brand=DHL&AWB=" . $TrackingT ."'target='_blank' rel='noopener'><button class='rb-button rb-button--primary'>Tracking Link</button></a><br><br>";
          }
      //echo "<u>Bearbeiter:</u> $BearbeiterT<br><br>";
      echo '</div></div>';
      }

if($DatumVS == 0) {
  echo '<div class="col-2 border">';
  echo '<img src="view/media/red.svg" width="50" height="50" alt="">';
  echo '<h5><img src="view/media/versand.png" width="40" height="30"alt="">&nbsp Ware versenden</h5><h6>(Ausstehend)<br><br></h5>';
  echo '</div>';	
} else {
    echo '<div class="col-2 border">';
    echo '<img src="view/media/green.svg" width="50" height="50" alt="">';
    echo '<h5><img src="view/media/versand.png" width="40" height="30"alt="">&nbsp Ware versendet<h5>';	
    echo '<hr width=60%>';
    echo "<h5> " . $DatumVS ." / " . $ZeitVS . "<br><br>";
    echo '<div class="text-left">';
    if($DienstleisterT != "TNT" && $DienstleisterT != "UPS" && $DienstleisterT != "DHL Express")  {
      echo "<u>Trackinginformation:</u> keine<br><br>";  
    }
    //echo "<u>Bearbeiter:</u> $BearbeiterVS<br><br>";
    echo '</div></div>';
}
echo '</div> <br />';
echo "-------------------------------------------------------- <br><br>";
echo '</div>'; 
}
}
}}
?> 
<br />
<br />

<?php
include("function/footer.php")  
?>
 
</body>  

</html> 

<?php
function sec_to_time($sekunden){

//if (!($sekunden >= 60)){
  //return $sekunden . 'Sekunden';
//}

  $minuten = bcdiv($sekunden, '60', 0);
  $sekunden = bcmod($sekunden, '60');

  if($sekunden >= 30){
    $minuten = ($minuten + 1);
  }

    if (!($minuten >= 60)){
        return $minuten . ' Min. '; //. $sekunden . ' Sekunden';
    }

      $stunden = bcdiv($minuten, '60', 0);
      $minuten = bcmod($minuten, '60');

        if (!($stunden >=24)){
            return $stunden . ' Std. ' . $minuten . ' Min. '; // . $sekunden . ' Sekunden '; 
        }

          $tage = bcdiv($stunden, '24', 0);
          $stunden = bcmod($stunden, '24');

          if ($stunden == 0){
            if ($tage == 1){
              return $tage . ' Tag ' . $minuten . ' Min. ';
            } 
              return $tage . ' Tage ' . $minuten . ' Min. ';
          } 
          
          if ($tage == 1){
              return $tage . ' Tag ' . $stunden . ' Std. ' . $minuten . ' Min. ';
          }

          if ($tage > 1){
              return $tage . ' Tage ' . $stunden . ' Std. ' . $minuten . ' Min. '; // . $sekunden . ' Sekunden '; 
          }      
  }
?>