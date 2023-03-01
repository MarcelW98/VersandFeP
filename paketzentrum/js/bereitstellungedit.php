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
    <title>Bereitstellen korrigieren</title>  
</head>   

<body class="bg">

<header class="bg-light fixed-top">
<!-- Header -->  
	<img src="view/media/colorbar.png" alt="colorbar" class="img-fluid" style="width: 100%"/> 
      <nav class="navbar navbar-light bg-faded">
		<a class="navbar-brand align-top">
            <img src="view/media/BoschLogoNavColored.png" width="180" height="40" class="d-inline-block" alt="Bosch Icon"/>
            Versand Werk Feuerbach &nbsp &nbsp &nbsp &nbsp <button class="align-self-end btn rb-button rb-button--primary" onclick="location.href = 'bereitstellung.php'">zurück zum bereitstellen</button></a>
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
  <a><img src="view/media/Logo_groß.png" width="620px" height="150px" class="d-inline-block rounded img-fluid" alt="LOGO"/>
  <br />
  <h1><p class="bg-danger text-white">Bereitstellen korrigieren</h1></p>
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
      <input type="text" style="text-align:center" id="barcode_scanbereit" ng-click="reset()" onfocus="" name="barcode_scanbereit" ng-model="insert.barcode_scanbereit" tabindex="1" class="form-control inputs" autofocus />
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

<!-- Lieferschein -->
<div class="form-group center-block text-center col-md-6">
		<label><strong>Lieferschein</strong><span class="text-danger">*</span></label>
      	<input type="number"  id="input_Lieferschein" name="input_Lieferschein"  ng-click="Liefer()" ng-focus="Liefer()" ng-model="insert.input_Lieferschein" class="form-control">
        <span class="bg-danger text-white" ng-hide="insert.input_Lieferschein" ng-show="errorLieferschein">{{errorLieferschein}}</span>
    </div>

	
<!-- Weitere Bearbeitung -->
    <div class="form-group center-block text-center col-md-6">
	<label><strong>Weitere Bearbeitung</strong><span class="text-danger">*</span></label>
	  <select id="input_Bearbeitung" name="input_Bearbeitung" ng-model="insert.input_Bearbeitung" class="form-control">
	  <option value="" selected disabled>Bitte Auswählen</option>
      <option ng-click="insertData()" value="W011927">W011927</option>
      <option ng-click="insertData()" value="Versandbuero">Versandbuero</option>
      </select>
      <span class="bg-danger text-white" ng-hide="insert.input_Bearbeitung" ng-show="errorWeitereBearbeitung">{{errorWeitereBearbeitung}}</span>
	</div>

</div>

<div class="row">

<!-- Länder Hinweis -->
<div class="form-group center-block text-center col-md-6">
	<label><strong>Länderhinweis</strong><span class="text-danger">*</span></label>
	  <select id="input_Lhinweis" name="input_Lhinweis" ng-model="insert.input_Lhinweis" class="form-control">
	  <option value="" selected disabled>Bitte Auswählen</option>
      <option value="Inland">Inland</option>
      <option value="EU">EU</option>
      <option value="Drittland">Drittland</option>
      </select>
      <span class="bg-danger text-white" ng-hide="insert.input_Lhinweis" ng-show="errorLhinweis">{{errorLhinweis}}</span>
	</div>

</div>

     <div class="form-group col-md-12 text-center">
	 <br />
      <input type="submit" id="insert" name="insert"  class="btn rb-button rb-button--primary btn-block"  value="Auftrag speichern" />	  
     </div>
     <div class="col-md-12 text-left">
	 <button class="btn btn-danger rb-button-sm" onclick="javascript:document.getElementById('barcode_scanbereit').focus()" ng-click="reset()" type="button">Eingabe zurücksetzen</button>
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

// Eingabeform prüfung und in Datenbank speichern
var app = angular.module("myapp", []);
	app.controller("formcontroller", function($scope, $http){
 $scope.insert = {};
 $scope.insertData = function(){
  $http({
   method:"POST",
   url:"function/bereitstellenedit.php",
   data:$scope.insert,   
  }).success(function(data){

// Überprüfung ob Priorisiert

if(data.prio)
{
    $scope.prio = data.prio.barcode_scanbereit;
}

// Fehlerbehandlung - Barcodescan wenn leer	  
	if(data.error1)
   {
    $scope.errorbarcodescan = data.error1.barcode_scanbereit;
    document.getElementById('barcode_scanbereit').focus();
    $scope.insert.barcode_scanbereit="";

    $scope.insert.input_Lieferschein="";
    $scope.insert.input_Bearbeitung="";
    $scope.insert.input_Lhinweis="";

    $scope.errorLieferschein="";
    $scope.errorWeitereBearbeitung="";
    $scope.errorLhinweis="";
    $scope.successInsert="";
    $scope.prio="";
    
   }

   else

// Fehlerbehandlung - Lieferschein leer  
   if(data.error2)
   {
    if(data.error2.input_Lieferschein > "") {
    $scope.errorbarcodescan= "";   
    $scope.errorLieferschein = data.error2.input_Lieferschein;
    document.getElementById('input_Lieferschein').focus();
    $scope.errorWeitereBearbeitung = data.error3.input_Bearbeitung;
    $scope.errorLhinweis = data.error4.input_Lhinweis;
    $scope.insert.input_Bearbeitung="";
    $scope.successInsert="";

    }
   }

   else

// Fehlerbehandlung - Weitere Bearbeitung leer  
   if(data.error3)
   {
    if(data.error3.input_Bearbeitung > "") {
    $scope.errorbarcodescan= ""; 
    $scope.errorWeitereBearbeitung = data.error3.input_Bearbeitung;
    document.getElementById('input_Bearbeitung').focus();
    $scope.errorLieferschein="";
    $scope.errorLhinweis = data.error4.input_Lhinweis;
    $scope.successInsert="";

    }
   }

   else

// Fehlerbehandlung - Länderhinweis leer  
   if(data.error4)
   {
    if(data.error4.input_Lhinweis > "") {
    $scope.errorbarcodescan= ""; 
    $scope.errorLhinweis = data.error4.input_Lhinweis;
    document.getElementById('input_Lhinweis').focus();
    $scope.errorLieferschein="";
    $scope.errorWeitereBearbeitung="";
    $scope.successInsert="";

    }
   }

   else

// Nach erfolgreicher Eingabe
   {
    $scope.insert="";
    $scope.errorbarcodescan="";
    $scope.errorLieferschein="";
    $scope.errorWeitereBearbeitung="";
    $scope.errorLhinweis="";
    $scope.prio="";
    $scope.successInsert = data.message;
    document.getElementById('barcode_scanbereit').focus();
   }

  });
 };

 // Eingabeform zurücksetzen
 $scope.reset = function() {
	 
			  $scope.successInsert="";
			  $scope.insert.barcode_scanbereit="";
              $scope.insert.input_Lieferschein="";
			  $scope.insert.input_Bearbeitung="";
              $scope.insert.input_Lhinweis="";
			  
			  $scope.errorbarcodescan="";
              $scope.prio="";
			  $scope.errorLieferschein="";
              $scope.errorWeitereBearbeitung="";
              $scope.errorLhinweis="";
              $scope.successInsert = data.message;			  
 }

 $scope.Liefer = function() {
	 

     $scope.insert.input_Lieferschein="";
     document.getElementById('input_Lieferschein').focus();
			  
}


});
</script>


<script type="text/javascript">
// Immer Barcodescan Auswählen
$(document).ready(function() {
$('#barcode_scanbereit').focus();
});
</script>

<script>
// Wenn "Enter" in Auftragsart dann button Klick
$(document).ready(function() {
    $("#input_Lhinweis").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>

<script>
// Wenn "Enter" in Auftragsart dann button Klick
$(document).ready(function() {
    $("#input_Bearbeitung").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>


