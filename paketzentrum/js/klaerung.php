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
    <title>Klärung</title>  
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
<div class="bg-warning container-fluid col-md-6 rounded text-center"> 
<br /> 
  <a><img src="view/media/Logo_groß.png" width="620px" height="150px" class="d-inline-block rounded img-fluid" alt="LOGO"/></a>
  <br />
  <h1><p class="">Auftrag zur Klärung</h1></p>
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
      <input type="text" style="text-align:center" id="barcode_scanklaer" ng-click="reset()" onfocus="" name="barcode_scanklaer" ng-model="insert.barcode_scanklaer" tabindex="1" class="form-control inputs" autofocus />
      <span class="bg-danger text-white" ng-show="errorbarcodescan">{{errorbarcodescan}}</span>
     </div>
     <div class="form-group col-md-12 center-block text-center">
     <h4><label class="fatred bg-white text-danger rounded center-block text-center" ng-show="prio"></p>&nbsp{{prio}}&nbsp</p></label></h4>
     <h4><label class="bg-success text-white rounded center-block text-center" ng-show="successInsert"></p>{{successInsert}}</p></label></h4>
     </div>
	 
<div class="row">

<!-- Grund -->
<div class="form-group center-block text-center col-md-6">
		<label><strong>Klärungshinweis</strong><span class="text-danger">*</span></label>
      	<input type="text" id="input_Grund" list="grundklareung"name="input_Grund" ng-model="insert.input_Grund" class="form-control confirmation">
          <datalist id="grundklareung">
        <option ng-click="insertData()" value="Zollsperre">Zollsperre</option>
        <option ng-click="insertData()" value="Gefahrgut">Gefahrgut</option>
        <option ng-click="insertData()" value="WorkOn-Genehmiger falsch">WorkOn-Genehmiger falsch</option>
      </datalist>
        <span class="bg-danger text-white" ng-hide="insert.input_Grund" ng-show="errorGrund">{{errorGrund}}</span>
    </div>




<!-- Bearbeiter -->
    	<div class="form-group center-block text-center col-md-6">
		<label><strong>Bearbeiter (VKS Nr.:)</strong><span class="text-danger">*</span></label>
      	<select id="input_Klaerbearbeiter" name="input_Klaerbearbeiter" ng-model="insert.input_Klaerbearbeiter" class="form-control">
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
        <span class="bg-danger text-white" ng-hide="insert.input_Klaerbearbeiter" ng-show="errorKlaerbearbeiter">{{errorKlaerbearbeiter}}</span>
    </div>

</div>

     <div class="form-group col-md-12 text-center">
	 <br />
      <input type="submit" id="insert" name="insert"  class="btn rb-button rb-button--primary btn-block" value="Auftrag speichern" />	  
     </div>
     <div class="col-md-12 text-left">
	 <button class="btn btn-danger rb-button-sm" onclick="javascript:document.getElementById('barcode_scanklaer').focus()" ng-click="reset()" type="button">Eingabe zurücksetzen</button>
     </div>    
    </form>
   </div>
  </div>

<br />

  <!-- Arbeitsvorat Anfang-->
  <div class="row"> 
<div class="bg-warning container-fluid col-md-11 text-center border rounded"> 
<div class="table-scrol">  
    <h2>Aktuelle Klärfälle</h2> 	  
  
<div class="table-responsive border bg-light"> <!--this is used for responsive display in mobile and other devices-->
    <table id="Arbeitsvorrat" class="table table-bordered table-hover table-striped" style="table-layout: fluid">  
        <thead>
        <tr>
			      <th>Auftragsnummer</th>
            <th>Datum Klärung</th>
			      <th>Zeit Klärung</th>
            <th>Klärungsgrund</th>
            <th>Bearbeiter VKS Klärung</th>
            <th>Nächste Beabeitung</th>
            <th>Priorität</th>
        </tr>  
        </thead>  
  
        <?php  
        include("database/db_conection.php");  
        $view_arbeitsvorrat_query="select * FROM versendungen WHERE Status_Klaerung='1' && Status_Storno='' ORDER by Prioritaet_Wareneingang='eilig' DESC, Datum_Klaerung ASC, Zeit_Klaerung ASC LIMIT 20";//select query for viewing users.  
        $run=mysqli_query($dbcon,$view_arbeitsvorrat_query);//here run the sql query.  

        while($row=mysqli_fetch_array($run)) //while look to fetch the result and store in a array $row.  
        {  
            $id=$row[0];
            $referenz=$row[1];
            $prioW=$row[7];
            $datumK=$row[33];
            $zeitK=$row[34];
            $grundK=$row[35];  
            $bearbK=$row[36];
            $StateV=$row[15];
            $StateB=$row[22];
            $StateT=$row[28]; 

        ?>  
        <tr>  
<!--here showing results in the table --> 
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><a class="Auftragsnummer" href="detail.php?id=<?php echo $referenz;?>"  style="color: black"> <?php echo $referenz;?> </a></td>
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $datumK;  ?></td>
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $zeitK;  ?></td>
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $grundK;  ?></td>
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $bearbK;  ?></td>
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php if($StateV == "" && $StateB == "" && $StateT == "" ) { echo "verpacken"; }  if($StateV == "1" && $StateB == "" && $StateT == "" ) { echo "bereitstellen"; } if($StateV == "1" && $StateB == "1" && $StateT == "" ) { echo "Transportapiere erstellen"; } if($StateV == "1" && $StateB == "1" && $StateT == "1" ) { echo "versenden"; } ?></td>
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $prioW;  ?></td>         	 	
        </tr>
        <?php } ?>  
    </table>  
        </div>
        <br />   
	</div>  
</div> 
</div>
<br />
<br />
<br />


</main>


<div id="ModalContainer">
</div>


  
<?php
include("function/footer.php") 
?> 

</body>    
</html>


<script>
$(document).ready(function(){
  $(".Auftragsnummer").click(function (e) {
      e.preventDefault();
      let url = $(this).attr("href");
      $.get(url, function(data, status) {
          $("#ModalContainer").html(data);
          $("#detailModal").modal('show');
      }); 
  });
});
</script>

<script>

     // TODO:  Do something here if the answer is "Ok".

// Eingabeform prüfung und in Datenbank speichern
var app = angular.module("myapp", []);
	app.controller("formcontroller", function($scope, $http){      
 $scope.insert = {};
 $scope.insertData = function(){
  $http({
   method:"POST",
   url:"function/klaerung.php",
   data:$scope.insert,   
  }).success(function(data){

// Überprüfung ob Priorisiert
if(data.prio)
{
    $scope.prio = data.prio.barcode_scanklaer;
}      

// Fehlerbehandlung - Barcodescan wenn leer	  
	if(data.error1)
   {
    $scope.errorbarcodescan = data.error1.barcode_scanklaer;
    document.getElementById('barcode_scanklaer').focus();
    $scope.insert.barcode_scanklaer="";

    $scope.insert.input_Grund="";
    $scope.insert.input_Klaerbearbeiter="";

    $scope.errorGrund="";
    $scope.errorKlaerbearbeiter="";
    $scope.successInsert="";
    $scope.prio="";
    
   }

   else

// Fehlerbehandlung - Grund leer  
   if(data.error2)
   {
    if(data.error2.input_Grund > "") {
    $scope.errorbarcodescan= "";   
    $scope.errorGrund = data.error2.input_Grund;
    document.getElementById('input_Grund').focus();
    $scope.errorKlaerbearbeiter = data.error3.input_Klaerbearbeiter;
    $scope.successInsert="";

    }
   }

   else


// Fehlerbehandlung - Bearbeiter leer  
   if(data.error3)
   {
    if(data.error3.input_Klaerbearbeiter > "") {
    $scope.errorbarcodescan= ""; 
    $scope.errorKlaerbearbeiter = data.error3.input_Klaerbearbeiter;
    document.getElementById('input_Klaerbearbeiter').focus();
    $scope.errorGrund="";
    $scope.successInsert="";

    }
   }

   else


// Nach erfolgreicher Eingabe
   {
    $scope.insert="";
    $scope.errorKlaerbearbeiter = "";
    $scope.errorGrund="";
    $scope.prio="";
    $scope.successInsert = data.message;
    document.getElementById('barcode_scanklaer').focus();
    $( "#Arbeitsvorrat" ).load("klaerung.php #Arbeitsvorrat");	
   }


  });
 };


 // Eingabeform zurücksetzen
 $scope.reset = function() {
    
		$scope.successInsert="";
		$scope.insert.barcode_scanklaer="";
        $scope.prio="";
        $scope.insert.input_Grund="";
        $scope.insert.input_Klaerbearbeiter="";
			  
		    $scope.errorbarcodescan="";
		    $scope.errorGrund="";
        $scope.errorStornobearbeiter="";

        $scope.successInsert = data.message;
        document.getElementById('barcode_scanklaer').focus();				  
 }
});
</script>




<script type="text/javascript">
// Immer Barcodescan Auswählen
$(document).ready(function() {
$('#barcode_scanklaer').focus();
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
    $("#input_Klaerbearbeiter").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>

<style type="text/css">
<!--
   #spezial
{
      background-color: #FA5858;
}
-->
</style>