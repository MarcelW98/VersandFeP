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
    <title>Wareneingang erfassen</title>  
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
    // echo "<a href='wareneingangedit.php'><button type='button' class='btn btn-dark rb-button-sm'>Wareneingang korrigieren</button></a>";   
} 

if($Admin == 1)
{
    echo "<a style='font-size:0.8vw;'><center><strong>Sie sind als Administrator eingeloggt</strong></center></a>";      
    echo "<a href='verwaltung.php'><button class='btn btn-success rb-button-sm'>Verwaltung</button></a>";
    // echo "<a href='wareneingangedit.php'><button type='button' class='btn btn-dark rb-button-sm'>Wareneingang korrigieren</button></a>";    
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
<div class="bg-warning container-fluid col-md-6 rounded text-center">
<br />   
  <a><img src="view/media/Logo_groß.png" width="620px" height="120px" class="d-inline-block rounded img-fluid" alt="LOGO"/><h1>Annahmeverweigerung erfassen</h1></a>
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
      <input type="text" style="text-align:center" id="barcode_scan" ng-click="reset()" name="barcode_scan" ng-model="insert.barcode_scan" tabindex="1" class="form-control inputs" autofocus />
      <span class="bg-danger text-white" ng-show="errorbarcodescan">{{errorbarcodescan}}</span>
     </div>
     <div class="form-group col-md-12 center-block text-center">
     <h4><label class="bg-success text-white rounded center-block text-center" ng-show="successInsert"></p>{{successInsert}}</p></label></h4>
     </div>
	 
<div class="row">

<!-- Grund -->
    <div class="form-group center-block text-center col-md-6">
	<label><strong>Grund</strong><span class="text-danger">*</span></label>
	  <select id="input_Grund" name="input_Grund"  ng-model="insert.input_Grund" tabindex="2" class="form-control">
      <option value="" selected disabled>Bitte Auswählen</option>
      <option ng-click="insertData()" value="Annahmeverweigerung">Annahmeverweigerung</option>	
      </select>    
	  <span class="bg-danger text-white" ng-hide="insert.input_Grund" ng-show="errorGrund">{{errorGrund}}</span>
	</div>

<!-- Bearbeiter -->
<div class="form-group center-block text-center col-md-6">
		<label><strong>Bearbeiter (VKS Nr.:)</strong><span class="text-danger">*</span></label>
      	<select id="input_Wareneingbearbeiter" name="input_Wareneingbearbeiter" ng-model="insert.input_Wareneingbearbeiter" tabindex="5" class="form-control">
          <option value="" selected disabled>Bitte Auswählen</option>
          <?php
				include("database/db_conection.php"); 
				$sql = 'SELECT * FROM vks ORDER by VKS_Nummer ASC';
				$result = mysqli_query($dbcon, $sql);
				while ($row = mysqli_fetch_array($result)) {
                echo '<option ng-click="insertData()">'. $row['VKS_Nummer'].'</option>';}
                mysqli_close($dbcon);
			?>
      </select> 
        <span class="bg-danger text-white" ng-hide="insert.input_Wareneingbearbeiter" ng-show="errorWareneingbearbeiter">{{errorWareneingbearbeiter}}</span>
    </div>	
</div>    




<div class="row">

    <!-- Hinweis -->
    <div class="form-group center-block text-center col-md-6">
            <label><strong>Hinweis</strong><span class="text-danger">*</span></label>
            <input type="text" id="input_Hinweis" list="hinweise" name="input_Hinweis" ng-model="insert.input_Hinweis" tabindex="6"  class="form-control">
            <datalist ng-click="insertData()" id="hinweise">
            <option ng-click="insertData()" value="Versandauftrag fehlt">Versandauftrag fehlt</option>
            <option ng-click="insertData()" value="Versandauftrag fehlerhaft">Versandauftrag fehlerhaft</option>
            <option ng-click="insertData()" value="Annahmeverweigerung Empfänger FeP Extern">Annahmeverweigerung Empfänger FeP Extern</option>	
            </datalist>
            <span class="bg-danger text-white" ng-hide="insert.input_Hinweis" ng-show="errorHinweis">{{errorHinweis}}</span>
    </div>
</div>

     <div class="form-group col-md-12 text-center">
	 <br />
      <input type="submit" id="insert" name="insert"  class="btn rb-button rb-button--primary btn-block" tabindex="6" value="Auftrag speichern" />	  
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
   url:"function/annahmev_insert.php",
   data:$scope.insert,   
  }).success(function(data){
      console.log(data);
// Fehlerbehandlung - Barcodescan wenn leer	  
	if(data.error1)
   {
    $scope.errorbarcodescan = data.error1.barcode_scan;
    document.getElementById('barcode_scan').focus();
    $scope.insert.barcode_scan="";
    $scope.errorGrund="";
    $scope.errorHinweis="";
    $scope.errorWareneingbearbeiter="";
    $scope.successInsert="";
    $scope.insert.input_Grund="";
    $scope.insert.input_Hinweis="";
    $scope.insert.input_Wareneingbearbeiter="";
    
   }
   else


// Fehlerbehandlung - Grund leer  
   if(data.error2)
   {
    if(data.error2.input_Grund > "") {
    $scope.errorbarcodescan= "";   
    $scope.errorGrund = data.error2.input_Grund;
    document.getElementById('input_Grund').focus();
    $scope.errorWareneingbearbeiter = data.error3.input_Wareneingbearbeiter;
    $scope.errorHinweis = data.error4.input_Hinweis;
    $scope.insert.input_Wareneingbearbeiter="";
    $scope.insert.input_Hinweis="";
    $scope.successInsert="";

    }
   }
   else

   // Fehlerbehandlung - Bearbeiter leer  
    if(data.error3)
   {
    if(data.error3.input_Wareneingbearbeiter > "") {
    $scope.errorbarcodescan= "";
    $scope.errorGrund="";   
    $scope.errorWareneingbearbeiter = data.error3.input_Wareneingbearbeiter;
    document.getElementById('input_Wareneingbearbeiter').focus();
    $scope.errorHinweis = data.error4.input_Hinweis;
    $scope.successInsert="";

    }
   }

   else

// Fehlerbehandlung - Hinweis leer  
if(data.error4)
   {
    if(data.error4.input_Hinweis > "") {
    $scope.errorbarcodescan= "";
    $scope.errorGrund="";
    $scope.errorWareneingbearbeiter = ""; 
    $scope.errorHinweis = data.error4.input_Hinweis;
    document.getElementById('input_Hinweis').focus();
    $scope.successInsert="";

    }
   }
   else




// Nach erfolgreicher Eingabe
   {
    $scope.insert="";
    $scope.errorbarcodescan="";
    $scope.errorGrund="";
    $scope.errorHinweis="";
    $scope.errorWareneingbearbeiter="";
    $scope.successInsert = data.message;
    document.getElementById('barcode_scan').focus();
   }

  });
 };

 // Eingabeform zurücksetzen
 $scope.reset = function() {
	 
			  $scope.successInsert="";
			  $scope.insert.barcode_scan="";
			  $scope.insert.input_Grund="";
              $scope.insert.input_Hinweis="";
			  $scope.insert.input_Wareneingbearbeiter="";
			  
			  $scope.errorbarcodescan="";
			  $scope.errorGrund="";
              $scope.errorHinweis="";
              $scope.errorWareneingbearbeiter="";
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
    $("#input_Grund").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>

<script>
// Wenn "Enter" in Bearbeiter dann button Klick
$(document).ready(function() {
    $("#input_Wareneingbearbeiter").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>

<script>
// Wenn "Enter" in Auftragsart dann button Klick
$(document).ready(function() {
    $("#input_Hinweis").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>
