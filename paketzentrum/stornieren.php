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
    <title>Auftrag storniern</title>  
</head>   

<body class="bg">
<script src="js/bootstrap.min.js"></script>	
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
  echo "<a><center><strong>Sie sind als Schichtführer eingeloggt</strong></center></a>";      
}

if($Admin == 1)
{
  echo "<a><center><strong>Sie sind als Administrator eingeloggt</strong></center></a>"; 
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
  <a><img src="view/media/Logo_groß.png" width="620px" height="150px" class="d-inline-block rounded img-fluid" alt="LOGO"/></a>
  <br />
  <h1><p class="bg-danger text-white">Auftrag storniern</h1></p>
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
      <input type="text" style="text-align:center" id="barcode_scanstorno" ng-click="reset()" onfocus="" name="barcode_scanstorno" ng-model="insert.barcode_scanstorno" tabindex="1" class="form-control inputs" autofocus />
      <span class="bg-danger text-white" ng-show="errorbarcodescan">{{errorbarcodescan}}</span>
     </div>
     <div class="form-group col-md-12 center-block text-center">
     <h4><label class="bg-success text-white rounded center-block text-center" ng-show="successInsert"></p>{{successInsert}}</p></label></h4>
     </div>
	 
<div class="row">

<!-- Grund -->
<div class="form-group center-block text-center col-md-6">
		<label><strong>Grund der Stornierung</strong><span class="text-danger">*</span></label>
      	<input type="text"  id="input_Grund" name="input_Grund" ng-model="insert.input_Grund" class="form-control confirmation">
        <span class="bg-danger text-white" ng-hide="insert.input_Grund"  ng-show="errorGrund">{{errorGrund}}</span>
    </div>




<!-- Bearbeiter -->
    	<div class="form-group center-block text-center col-md-6">
		<label><strong>Bearbeiter (VKS Nr.:)</strong><span class="text-danger">*</span></label>
      	<select id="input_Stornobearbeiter" name="input_Stornobearbeiter" ng-model="insert.input_Stornobearbeiter" class="form-control">
        <option value="" selected disabled>Bitte Auswählen</option>
          <?php
				include("database/db_conection.php"); 
				$sql = 'SELECT * FROM vks ORDER by VKS_Nummer ASC';
				$result = mysqli_query($dbcon, $sql);
				while ($row = mysqli_fetch_array($result)) {
                echo '<option>'. $row['VKS_Nummer'].'</option>';}
                mysqli_close($dbcon);
			?>
      </select>
        <span class="bg-danger text-white" ng-show="errorStornobearbeiter">{{errorStornobearbeiter}}</span>
    </div>
	
<!-- Modal GB -->
<div class="modal fade" id="stornobestätigung" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Auftrag stornieren?</h5>
        <button type="button" class="close" data-dismiss="modal" ng-click="reset()" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="panel-body">  
        <p>Möchten sie wirklich den Auftag stornieren</p>
        </div> 

        <div class="modal-footer">
        <button class="btn btn-success rb-button" data-dismiss="modal" ng-click="storno()" type="button">Ja</button>
          <button type="button" class="btn btn-danger rb-button" data-dismiss="modal" ng-click="reset()">Nein</button>
        </div>
      </div>
    </div>
  </div>
</div>
<!-- Modal GB Ende -->



</div>

     <div class="form-group col-md-12 text-center">
	 <br />
      <input type="submit" id="insert" name="insert"  class="btn rb-button rb-button--primary btn-block" value="Auftrag speichern" />	  
     </div>
     <div class="col-md-12 text-left">
	 <button class="btn btn-danger rb-button-sm" onclick="javascript:document.getElementById('barcode_scanstorno').focus()" ng-click="reset()" type="button">Eingabe zurücksetzen</button>
   <?php     
if($Schicht == 1)
{
  echo "<a href='stornoreset.php'><button type='button' style='position: absolute; right: 235;'class='btn btn-dark rb-button-sm'>Storno zurücksetzten</button></a>";     
}

if($Admin == 1)
{
  echo "<a href='stornoreset.php'><button type='button' style='position: absolute; right: 235;'class='btn btn-dark rb-button-sm'>Storno zurücksetzten</button></a>";
       
}
?>
     
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


     // TODO:  Do something here if the answer is "Ok".

// Eingabeform prüfung und in Datenbank speichern
var app = angular.module("myapp", []);
	app.controller("formcontroller", function($scope, $http){      
 $scope.insert = {};
 $scope.insertData = function(){
  $http({
   method:"POST",
   url:"function/stornoabfrage.php",
   data:$scope.insert,   
  }).success(function(data){

// Fehlerbehandlung - Barcodescan wenn leer	  
	if(data.error1)
   {
    $scope.errorbarcodescan = data.error1.barcode_scanstorno;
    document.getElementById('barcode_scanstorno').focus();
    $scope.insert.barcode_scanstorno="";

    $scope.insert.input_Grund="";
    $scope.insert.input_Stornobearbeiter="";

    $scope.errorGrund="";
    $scope.errorStornobearbeiter="";
    $scope.successInsert="";
    
   }

   else

// Fehlerbehandlung - Grund leer  
   if(data.error2)
   {
    if(data.error2.input_Grund > "") {
    $scope.errorbarcodescan= "";   
    $scope.errorGrund = data.error2.input_Grund;
    document.getElementById('input_Grund').focus();
    $scope.errorStornobearbeiter = data.error3.input_Stornobearbeiter;
    $scope.successInsert="";

    }
   }

   else


// Fehlerbehandlung - Bearbeiter leer  
   if(data.error3)
   {
    if(data.error3.input_Stornobearbeiter > "") {
    $scope.errorbarcodescan= ""; 
    $scope.errorStornobearbeiter = data.error3.input_Stornobearbeiter;
    document.getElementById('input_Stornobearbeiter').focus();
    $scope.errorGrund="";
    $scope.successInsert="";

    }
   }

   else


// Nach erfolgreicher Eingabe
   {
    $scope.errorStornobearbeiter = "";
    $("#stornobestätigung").modal('show')
    document.getElementById('ok').focus();
   }

  });
 };

{
 $scope.storno = function() {

$http({
 method:"POST",
 url:"function/storno.php",
 data:$scope.insert,   
}).success(function(data){

    
    $scope.insert.barcode_scanstorno="";
    $scope.insert.input_Grund="";
    $scope.insert.input_Stornobearbeiter="";
      
      $scope.errorbarcodescan="";
      $scope.errorGrund="";
      $scope.errorStornobearbeiter="";
      $scope.successInsert = data.message;
      document.getElementById('barcode_scanstorno').focus();

});

 }}


 // Eingabeform zurücksetzen
 $scope.reset = function() {
    
			  $scope.successInsert="";
			  $scope.insert.barcode_scanstorno="";
        $scope.insert.input_Grund="";
        $scope.insert.input_Stornobearbeiter="";
			  
			  $scope.errorbarcodescan="";
			  $scope.errorGrund="";
        $scope.errorStornobearbeiter="";

        $scope.successInsert = data.message;			  
 }
});
</script>




<script type="text/javascript">
// Immer Barcodescan Auswählen
$(document).ready(function() {
$('#barcode_scanstorno').focus();
});
</script>


<script>
// Wenn "Enter" in Auftragsart dann button Klick
$(document).ready(function() {
    $("#input_Stornobearbeiter").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>



