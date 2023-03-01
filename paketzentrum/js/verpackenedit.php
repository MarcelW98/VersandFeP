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
    <title>Verpacken korrigieren</title>  
</head>   

<body class="bg">

<header class="bg-light fixed-top">
<!-- Header -->  
	<img src="view/media/colorbar.png" alt="colorbar" class="img-fluid" style="width: 100%"/> 
      <nav class="navbar navbar-light bg-faded">
		<a class="navbar-brand align-top">
            <img src="view/media/BoschLogoNavColored.png" width="180" height="40" class="d-inline-block" alt="Bosch Icon"/>
            Versand Werk Feuerbach &nbsp &nbsp &nbsp &nbsp <button class="align-self-end btn rb-button rb-button--primary" onclick="location.href = 'verpacken.php'">zurück zum verpacken</button></a>
            <?php 
if($Schicht == 1)
{  
    echo "<a style='font-size:0.8vw;'><center><strong>Sie sind als Schichtführer eingeloggt</strong><br>(nach 10 Minuten Inaktivität werden Sie automatisch abgemeldet.)</center></a>";    
} 

if($Admin == 1)
{
    echo "<a style='font-size:0.8vw;'><center><strong>Sie sind als Administrator eingeloggt</strong><br>(nach 10 Minuten Inaktivität werden Sie automatisch abgemeldet.)</center></a>";  
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
  <a><img src="view/media/Logo_groß.png" width="620px" height="150px" class="d-inline-block rounded img-fluid" alt="LOGO"/><h1>Verpacken korrigieren</h1></a>
  <br />
 </div> 
<br />
<main>
 <div class="container-fluid col-md-12 border rounded" style="width:700px; background-color: #efeff0;">
  
   <div ng-app="myappver" ng-controller="formcontrollerver">
    <form name="userForm" ng-submit="insertData()">
	
<!-- Barcode Scan -->
     <div class="form-group col-md-12 center-block text-center">
      <label><h2><strong>Barcode scannen <span class="text-danger">*</span></strong></h2></label>
      <input type="text" style="text-align:center" id="barcode_scanver" ng-click="reset()" name="barcode_scanver" ng-model="insert.barcode_scanver" class="form-control inputs" autofocus />
      <span class="bg-danger text-white" ng-show="errorbarcodescan">{{errorbarcodescan}}</span>
     </div>
     <div class="form-group col-md-12 center-block text-center">
     <h4><label class="fatred bg-white text-danger rounded center-block text-center" ng-show="prio"></p>&nbsp{{prio}}&nbsp</p></label></h4>
     <h4><label class="bg-success text-white rounded center-block text-center" ng-show="successInsert"></p>{{successInsert}}</p></label></h4>
     </div>

     <div class="form-group col-md-12 center-block text-center">
     <label class="bg-warning" style="text-align:center"><strong> Folgende Eingaben können korrigiert werden. &nbsp &nbsp <br> &nbsp &nbsp &nbsp &nbsp (Ursprünglicher Zeitstempel und VKS Nr. bleiben erhalten) &nbsp &nbsp &nbsp &nbsp </strong></label>
     </div>
	 

<!-- Ambaße und Gewicht -->

<div class="row">
<div class="form-group col-md-12 center-block text-center">
<label><strong>Abmaße (in cm) und Gewicht (in kg)</strong><span class="text-danger">*</span></label>
</div>
     
    <div class=" form-group col-sm-2"> 
    <input type="text" style="text-align:center" class="form-control" placeholder="Länge" id="input_l" name="input_l" ng-model="insert.input_l" ></div>
    <div>cm&nbsp * &nbsp</div>
        <div class="form-group col-sm-2"> 
        <input type="text"  style="text-align:center" class="form-control" placeholder="Breite" id="input_b" name="input_b" ng-model="insert.input_b" ></div>
        <div>cm&nbsp * &nbsp</div>
            <div class=" form-group col-sm-2">
            <input type="text" style="text-align:center" class="form-control" placeholder="Höhe" id="input_h" name="input_h" ng-model="insert.input_h" ></div>
            <div>cm &nbsp &nbsp &nbsp--></div>
                <div class=" form-group col-sm-2">
                    <input type="text" style="text-align:center" class="form-control" placeholder="Gewicht" id="input_g" name="input_g" ng-model="insert.input_g" ></div>
                    <div>Kg</div>
    </div>
<!-- Ambaße und Gewicht Fehlerbehandlung -->
    <div class="row">
    <div class=" form-group col-sm-3"> 
    <span class="bg-danger text-white" ng-show="errorlaenge">{{errorlaenge}}</span></div>
        <div class="form-group col-sm-3"> 
        <span class="bg-danger text-white" ng-show="errorbreite">{{errorbreite}}</span></div>
            <div class=" form-group col-sm-3">
            <span class="bg-danger text-white" ng-show="errorhoehe">{{errorhoehe}}</span></div>
                <div class=" form-group col-sm-3">
                    <span class="bg-danger text-white" ng-show="errorgewicht">{{errorgewicht}}</span></div>

    </div>

     <div class="form-group col-md-12 text-center">
	 <br />
      <input type="submit" id="insert"name="insert" class="btn rb-button rb-button--primary btn-block" value="Auftrag speichern" />
	  
     </div>
     <div class="col-md-12 text-left">
	 <button class="btn btn-danger rb-button-sm" onclick="javascript:document.getElementById('barcode_scanver').focus()" ng-click="reset()" type="button">Eingabe zurücksetzen</button>

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

<script>
var app = angular.module("myappver", []);
	app.controller("formcontrollerver", function($scope, $http){
 $scope.insert = {};
 $scope.insertData = function(){
  $http({
   method:"POST",
   url:"function/verpackenedit.php",
   data:$scope.insert,   
  }).success(function(data){

// Überprüfung ob Priorisiert
   if(data.prio)
{
    $scope.prio = data.prio.barcode_scanver;
}

// Fehlerbehandlung - Barcodescan wenn leer	
	if(data.error1)
   {
    $scope.errorbarcodescan = data.error1.barcode_scanver;
    document.getElementById('barcode_scanver').focus();
    $scope.insert.barcode_scanver="";
    $scope.errorlaenge="";
    $scope.errorbreite=""; 
    $scope.errorhoehe=""; 
    $scope.errorgewicht=""; 
    $scope.successInsert="";
    $scope.insert.input_l="";
    $scope.insert.input_b="";
    $scope.insert.input_h="";
    $scope.insert.input_g="";
    $scope.prio="";
   }
   else


   // Fehlerbehandlung - Länge leer  
if(data.error2)
   {
    if(data.error2.input_l> "") 
    {
    $scope.errorbarcodescan= ""; 
    $scope.errorlaenge = data.error2.input_l;
    document.getElementById('input_l').focus();
    $scope.errorbreite = data.error3.input_b; 
    $scope.errorhoehe = data.error4.input_h; 
    $scope.errorgewicht = data.error5.input_g; 
    $scope.successInsert="";

    }
   }

   else

   // Fehlerbehandlung - Breite leer  
   if(data.error3)
   {
    if(data.error3.input_b> "") 
    {
    $scope.errorbarcodescan= ""; 
    $scope.errorlaenge = ""; 
    $scope.errorbreite = data.error3.input_b;
    document.getElementById('input_b').focus(); 
    $scope.errorhoehe = data.error4.input_h; 
    $scope.errorgewicht = data.error5.input_g; 
    $scope.successInsert="";

    }
   }

   else

      // Fehlerbehandlung - Höhe leer  
    if(data.error4)
   {
    if(data.error4.input_h> "") 
    {
    $scope.errorbarcodescan= ""; 
    $scope.errorlaenge = ""; 
    $scope.errorbreite = "";
    $scope.errorhoehe = data.error4.input_h; 
    document.getElementById('input_h').focus(); 
    $scope.errorgewicht = data.error5.input_g; 
    $scope.successInsert="";

    }
   }

   else

    // Fehlerbehandlung - Gewicht leer  
    if(data.error5)
   {
    if(data.error5.input_g> "") 
    {
    $scope.errorbarcodescan= ""; 
    $scope.errorlaenge = ""; 
    $scope.errorbreite = "";
    $scope.errorhoehe = "";
    $scope.errorgewicht = data.error5.input_g;  
    document.getElementById('input_g').focus(); 
    $scope.successInsert="";

    }
   }

   else



// Nach erfolgreicher Eingabe
   {   
    $scope.insert="";
    $scope.errorbarcodescan="";
    $scope.errorlaenge="";
    $scope.errorbreite="";
    $scope.errorhoehe=""; 
    $scope.errorgewicht="";
    $scope.prio="";
    $scope.successInsert = data.message;
    document.getElementById('barcode_scanver').focus();
   }

  });
 };

  // Eingabeform zurücksetzen
 $scope.reset = function() {
	 
			$scope.successInsert="";
			$scope.insert.barcode_scanver="";
            $scope.insert.input_l="";
            $scope.insert.input_b="";
            $scope.insert.input_h="";
            $scope.insert.input_g="";
			
            

			$scope.errorbarcodescan="";
            $scope.prio="";
            $scope.errorlaenge="";
            $scope.errorbreite="";
            $scope.errorhoehe=""; 
            $scope.errorgewicht="";
            $scope.successInsert = data.message;
            document.getElementById('barcode_scanver').focus();			  
 }		  
});
</script>


<script type="text/javascript">
// Immer Barcodescan Auswählen
$(document).ready(function() {
$('#barcode_scanver').focus();
});
</script>


<script>
// Wenn "Enter" in Auftragsart dann button Klick
$(document).ready(function() {
    $("#input_l").keyup(function(event) {
if (event.keyCode == 9) {
    $("#insert").click();
}
});
});
</script>

<script>
// Wenn "Enter" in Auftragsart dann button Klick
$(document).ready(function() {
    $("#input_b").keyup(function(event) {
if (event.keyCode == 9) {
    $("#insert").click();
}
});
});
</script>

<script>
// Wenn "Enter" in Auftragsart dann button Klick
$(document).ready(function() {
    $("#input_h").keyup(function(event) {
if (event.keyCode == 9) {
    $("#insert").click();
}
});
});
</script>

<script>
// Wenn "Enter" in Auftragsart dann button Klick
$(document).ready(function() {
    $("#input_g").keyup(function(event) {
if (event.keyCode == 9) {
    $("#insert").click();
}
});
});
</script>