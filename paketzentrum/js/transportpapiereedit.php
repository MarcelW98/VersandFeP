<?php  
session_start();  

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
    <title>Transportpapiere korrigieren</title>  
</head>   

<body class="bg">

<header class="bg-light fixed-top">
<!-- Header -->  
	<img src="view/media/colorbar.png" alt="colorbar" class="img-fluid" style="width: 100%"/> 
      <nav class="navbar navbar-light bg-faded">
		<a class="navbar-brand align-top">
            <img src="view/media/BoschLogoNavColored.png" width="180" height="40" class="d-inline-block" alt="Bosch Icon"/>
            Versand Werk Feuerbach &nbsp &nbsp &nbsp &nbsp <button class="align-self-end btn rb-button rb-button--primary" onclick="location.href = 'paketzentrum.php'">zurück zur Übersicht</button></a>
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
<div class="bg-danger container-fluid col-md-6 rounded text-center">
<br />     
  <a><img src="view/media/Logo_groß.png" width="620px" height="150px" class="d-inline-block rounded img-fluid" alt="LOGO"/>
  <br />
  <h1><p class="bg-danger text-white">Transportpapiere korrigieren</h1></p>
  <br />
 </div> 
<br />
<main>
 <div class="container-fluid col-md-12 border rounded" style="width:700px; background-color: #efeff0;">
  
   <div ng-app="myapp" ng-controller="formcontroller">
    <form id="userForm" name="userForm" ng-submit="insertData()">
	
     <!-- Barcode Scan -->
     <div class="form-group col-md-12 center-block text-center">
      <label><h2><strong>Barcode scannen <span class="text-danger">*</span></strong></h2></label>
      <input type="text" style="text-align:center" id="barcode_scantrans" ng-click="reset()" onfocus="" name="barcode_scantrans" ng-model="insert.barcode_scantrans" tabindex="1" class="form-control inputs" autofocus />
      <span class="bg-danger text-white" ng-show="errorbarcodescan">{{errorbarcodescan}}</span>
     </div>
     <div class="form-group col-md-12 center-block text-center">
     <h4><label class="fatred bg-white text-danger rounded center-block text-center" ng-show="prio"></p>&nbsp{{prio}}&nbsp</p></label></h4>
     <h4><label class="bg-success text-white rounded center-block text-center" ng-show="successInsert"></p>{{successInsert}}</p></label></h4>
     </div>

     <div class="form-group col-md-12 center-block text-center">
     <label class="bg-warning" style="text-align:center"><strong> Folgende Eingaben können korrigiert werden. &nbsp &nbsp <br> &nbsp &nbsp &nbsp &nbsp (Ursprünglicher Zeitstempel und VKS Nr. bleiben erhalten) &nbsp &nbsp &nbsp &nbsp </strong></label>
     </div>
	 
<div class="row">

<!-- Dienstleister -->
<div class="form-group center-block text-center col-md-6">
	<label><strong>Dienstleister</strong><span class="text-danger">*</span></label>
	  <select id="input_Dienstleister" name="input_Dienstleister" ng-model="insert.input_Dienstleister" class="form-control">
	  <option value="" selected disabled>Bitte Auswählen</option>
      <option ng-click="insertData()" value="TNT">TNT</option>
      <option ng-click="insertData()" value="UPS">UPS</option>
      <option ng-click="insertData()" value="DHL Express">DHL Express</option>
      <option value="LGI">LGI</option>
      <option value="Sonstige">Sonstige</option>
      </select>
      <span class="bg-danger text-white" ng-show="errordienstleister">{{errordienstleister}}</span>
	</div>



<!-- Tracking Nr. -->
<div class="form-group center-block text-center col-md-6">
		<label><strong>Tracking Nr.</strong><span class="text-danger">*</span></label>
        <label><font size="2">Nur bei Paketdienstleister eingeben!</font></label>
      	<input id="input_Tracking" name="input_Tracking" ng-click="Track()" ng-model="insert.input_Tracking" class="form-control">
        <span class="bg-danger text-white" ng-show="errortracking">{{errortracking}}</span>
    </div>

</div>


     <div class="form-group col-md-12 text-center">
	 <br />
      <input type="submit" id="insert" name="insert"  class="btn rb-button rb-button--primary btn-block"  value="Auftrag speichern" />	  
     </div>
     <div class="col-md-12 text-left">
	 <button class="btn btn-danger rb-button-sm" onclick="javascript:document.getElementById('barcode_scantrans').focus()" ng-click="reset()" type="button">Eingabe zurücksetzen</button>
     </div>    
    </form>
   </div>
  </div>
  <br />
<br />
  </main>


<?php
include("function/footer.php")  
?> 

</body>    
</html>

<script>

// Eingabeform prüfung und in Datenbank speichern
var app = angular.module("myapp", []);
	app.controller("formcontroller", function($scope, $http){
 $scope.insert = {};
 $scope.insertData = function(){
  $http({
   method:"POST",
   url:"function/transportpapiereedit.php",
   data:$scope.insert,   
  }).success(function(data){

// Überprüfung ob Priorisiert

if(data.prio)
{
    $scope.prio = data.prio.barcode_scantrans;
}      

// Fehlerbehandlung - Barcodescan wenn leer	  
	if(data.error1)
   {
    $scope.errorbarcodescan = data.error1.barcode_scantrans;
    document.getElementById('barcode_scantrans').focus();
    $scope.insert.barcode_scantrans="";

    $scope.insert.input_Dienstleister="";
    $scope.insert.input_Tracking="";

    $scope.errordienstleister="";
    $scope.errortracking="";
    $scope.successInsert="";
    $scope.prio="";
    
   }

   else

// Fehlerbehandlung - Dienstleister leer  
   if(data.error2)
   {
    if(data.error2.input_Dienstleister > "") {
    $scope.errorbarcodescan= "";   
    $scope.errordienstleister = data.error2.input_Dienstleister;
    document.getElementById('input_Dienstleister').focus();
    $scope.errortracking = "";
    $scope.successInsert="";

    }
   }

   else


// Fehlerbehandlung - Tracking leer  
   if(data.error3)
   {
    if(data.error3.input_Tracking > "") {
    $scope.errorbarcodescan= ""; 
    $scope.errortracking = data.error3.input_Tracking;
    document.getElementById('input_Tracking').focus();
    $scope.errordienstleister="";
    $scope.successInsert="";

    }
   }

   else


// Nach erfolgreicher Eingabe
   {
    $scope.insert="";
    $scope.errorbarcodescan="";
    $scope.errordienstleister="";
    $scope.errortracking="";
    $scope.prio="";
    $scope.successInsert = data.message;
    document.getElementById('barcode_scantrans').focus();
   }

  });
 };

 // Eingabeform zurücksetzen
 $scope.reset = function() {
	 
			  $scope.successInsert="";
			  $scope.insert.barcode_scantrans="";
              $scope.insert.input_Dienstleister="";
			  $scope.insert.input_Tracking="";
              			  
			  $scope.errorbarcodescan="";
			  $scope.errordienstleister="";
              $scope.errortracking="";
              
              $scope.prio="";
              $scope.successInsert = data.message;			  
 }

 $scope.Track = function() {
	 

     $scope.insert.input_Tracking="";
     document.getElementById('input_Tracking').focus();
			  
}


});
</script>


<script type="text/javascript">
// Immer Barcodescan Auswählen
$(document).ready(function() {
$('#barcode_scantrans').focus();
});
</script>

<script>
// Wenn "Enter" in Auftragsart dann button Klick
$(document).ready(function() {
    $("#input_Dienstleister").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>


