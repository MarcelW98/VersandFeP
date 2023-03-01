<?php  
session_start();  

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
  
<head lang="en">  
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="view/media/favicon.ico">  
    <link type="text/css" rel="stylesheet" href="css\bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/sticky-footer-navbar.css">
	<link rel="stylesheet" href="css/rb_design.css">
	<script src="js/angular.js"></script>  
	<script src="js/jquery.min.js"></script>
    <title>Wareneingang korrigieren</title>  
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
<div class="bg-danger container-fluid col-md-6 rounded text-center">
<br />     
  <a><img src="view/media/Logo_groß.png" width="620px" height="120px" class="d-inline-block rounded img-fluid" alt="LOGO"/>
  <br />
  <h1><p class="bg-danger text-white">Wareneingang korrigieren</h1></p>
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
      <input type="text" style="text-align:center" id="barcode_scan" ng-click="reset()" onfocus="" name="barcode_scan" ng-model="insert.barcode_scan" tabindex="1" class="form-control inputs" autofocus />
      <span class="bg-danger text-white" ng-show="errorbarcodescan">{{errorbarcodescan}}</span>
     </div>
     <div class="form-group col-md-12 center-block text-center">
     <h4><label class="bg-success text-white rounded center-block text-center" ng-show="successInsert"></p>{{successInsert}}</p></label></h4>
     </div>

     <div class="form-group col-md-12 center-block text-center">
     <label class="bg-warning" style="text-align:center"><strong> Folgende Eingaben können korrigiert werden. &nbsp &nbsp <br> &nbsp &nbsp &nbsp &nbsp (Ursprünglicher Zeitstempel und VKS Nr. bleiben erhalten) &nbsp &nbsp &nbsp &nbsp </strong></label>
     </div>
	 
<div class="row">

<!-- Auftragsart -->
    <div class="form-group center-block text-center col-md-6">
	<label><strong>Auftragsart</strong><span class="text-danger">*</span></label>
	  <select id="input_Auftragsart" name="input_Auftragsart" ng-model="insert.input_Auftragsart" tabindex="2" class="form-control" >
	  <option value="" selected disabled>Bitte Auswählen</option>	
 		<?php
				include("database/db_conection.php"); 
				$sql = 'SELECT * FROM auftragsart';
				$result = mysqli_query($dbcon, $sql);
				while ($row = mysqli_fetch_array($result)) {
                echo '<option ng-click="insertData()">'. $row['Auftragsart'].'</option>';}
                mysqli_close($dbcon);
			?>
      </select>    
	  <span class="bg-danger text-white" ng-hide="insert.input_Auftragsart" ng-show="errorAuftragsart">{{errorAuftragsart}}</span>
	</div>
	
<!-- Geschäftsbereich -->
    <div class="form-group center-block text-center col-md-6">
	<label><strong>Geschäftsbereich</strong><span class="text-danger">*</span></label>
	  <select type="text" id="input_GB" name="input_GB" ng-model="insert.input_GB" tabindex="3" class="form-control">
	  <option value="" selected disabled>Bitte Auswählen</option>
 		<?php
				include("database/db_conection.php"); 
				$sql = 'SELECT * FROM gb';
				$result = mysqli_query($dbcon, $sql);
				while ($row = mysqli_fetch_array($result)) {
                echo '<option ng-click="insertData()">'. $row['GB'].'</option>';}
                mysqli_close($dbcon);
			?>
      </select>
      <span class="bg-danger text-white" ng-hide="insert.input_GB" ng-show="errorGB">{{errorGB}}</span>
	</div>

</div>


<div class="row">

<!-- Priorität -->
<div class="form-group center-block text-center col-md-6">
	<label><strong>Priorität</strong><span class="text-danger">*</span></label>
	  <select type="text" id="input_Prio" name="input_Prio" ng-model="insert.input_Prio" class="form-control">
	  <option value="" selected disabled>Bitte Auswählen</option>
      <option ng-click="insertData()" value="normal">normal</option>
      <option ng-click="insertData()" value="eilig">eilig</option>
      </select>
      <span class="bg-danger text-white" ng-hide="insert.input_Prio" ng-show="errorprio">{{errorprio}}</span>
    </div>
    

<!-- Hinweis -->
<div class="form-group center-block text-center col-md-6">
	<label><strong>Hinweis</strong><span class="text-danger">*</span></label>
	  <input type="text" id="input_Hinweis" list="hinweise" name="input_Hinweis" ng-model="insert.input_Hinweis" tabindex="6"  class="form-control">
      <datalist id="hinweise">
 		<?php
				include("database/db_conection.php"); 
				$sql = 'SELECT * FROM hinweis';
				$result = mysqli_query($dbcon, $sql);
				while ($row = mysqli_fetch_array($result)) {
                echo '<option ng-click="insertData()" >'. $row['Hinweise'].'</option>';}
                mysqli_close($dbcon);
			?>
      </datalist>
      <span class="bg-danger text-white" ng-hide="insert.input_Hinweis" ng-show="errorHinweis">{{errorHinweis}}</span>
	</div>


</div>


     <div class="form-group col-md-12 text-center">
	 <br />
      <input type="submit" id="insert" name="insert"  class="btn rb-button rb-button--primary btn-block"  value="Auftrag speichern" />	  
     </div>
     <div class="col-md-12 text-left">
	 <button class="btn btn-danger rb-button-sm" onclick="javascript:document.getElementById('barcode_scan').focus()" ng-click="reset()" type="button">Eingabe zurücksetzen</button>
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
   url:"function/insertedit.php",
   data:$scope.insert,   
  }).success(function(data){

// Fehlerbehandlung - Barcodescan wenn leer	  
	if(data.error1)
   {
    $scope.errorbarcodescan = data.error1.barcode_scan;
    document.getElementById('barcode_scan').focus();
    $scope.insert.barcode_scan="";
    $scope.errorAuftragsart="";
    $scope.errorGB="";
    $scope.errorHinweis="";
    $scope.errorprio=""; 
    $scope.successInsert="";
    $scope.insert.input_Auftragsart="";
    $scope.insert.input_GB="";
	$scope.insert.input_Prio="";
    $scope.insert.input_Hinweis="";
    
    
   }
   else


// Fehlerbehandlung - Auftragsart leer  
   if(data.error2)
   {
    if(data.error2.input_Auftragsart > "") {
    $scope.errorbarcodescan= "";   
    $scope.errorAuftragsart = data.error2.input_Auftragsart;
    document.getElementById('input_Auftragsart').focus();
    $scope.errorGB = data.error3.input_GB;
    $scope.errorprio = data.error4.input_Prio;
    $scope.errorHinweis = data.error5.input_Hinweis;
    $scope.insert.input_Prio="";
    $scope.successInsert="";

    }
   }
   else

// Fehlerbehandlung - GB leer  
   if(data.error3)
   {
    if(data.error3.input_GB > "") {
    $scope.errorbarcodescan= ""; 
    $scope.errorGB = data.error3.input_GB;
    document.getElementById('input_GB').focus();
    $scope.errorAuftragsart="";
    $scope.errorprio = data.error4.input_Prio;
    $scope.errorHinweis = data.error5.input_Hinweis;
    $scope.successInsert="";

    }
   }
   else


// Fehlerbehandlung - Prio leer  
   if(data.error4)
   {
    if(data.error4.input_Prio > "") {
    $scope.errorbarcodescan= "";   
    $scope.errorprio = data.error4.input_Prio;
    document.getElementById('input_Prio').focus();
    $scope.errorAuftragsart="";
    $scope.errorGB="";
    $scope.errorHinweis = data.error5.input_Hinweis;
    $scope.successInsert="";

    }
   }


   else
   
// Fehlerbehandlung - Hinweis leer  
if(data.error5)
   {
    if(data.error5.input_Hinweis > "") {
    $scope.errorbarcodescan= ""; 
    $scope.errorHinweis = data.error5.input_Hinweis;
    document.getElementById('input_Hinweis').focus();
    $scope.errorAuftragsart="";
    $scope.errorGB="";
    $scope.errorprio="";
    $scope.successInsert="";

    }
   }
   else

// Nach erfolgreicher Eingabe
   {
    $scope.insert="";
    $scope.errorbarcodescan="";
    $scope.errorAuftragsart="";
    $scope.errorGB="";
    $scope.errorprio="";
    $scope.errorHinweis="";
    $scope.successInsert = data.message;
    document.getElementById('barcode_scan').focus();
   }

  });
 };

 // Eingabeform zurücksetzen
 $scope.reset = function() {
	 
			  $scope.successInsert="";
			  $scope.insert.barcode_scan="";
			  $scope.insert.input_GB="";
			  $scope.insert.input_Auftragsart="";
			  $scope.insert.input_Prio="";
			  $scope.insert.input_Hinweis="";
              
			  
			  $scope.errorbarcodescan="";
			  $scope.errorAuftragsart="";
              $scope.errorGB="";
              $scope.errorprio="";
              $scope.errorHinweis="";
              $scope.successInsert = data.message;			  
 }		  
});
</script>


<script type="text/javascript">
// Immer Barcodescan Auswählen
$(document).ready(function() {
$('#barcode_scan').focus();
});
</script>

<script>
// Wenn "Enter" in Auftragsart dann button Klick
$(document).ready(function() {
    $("#input_Auftragsart").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>

<script>
// Wenn "Enter" in GB dann button Klick
$(document).ready(function() {
    $("#input_GB").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>


<script>
// Wenn "Enter" in Prio dann button Klick
$(document).ready(function() {
    $("#input_Prio").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>

<script>
// Wenn "Enter" in Hinweis dann button Klick
$(document).ready(function() {
    $("#input_Hinweis").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>