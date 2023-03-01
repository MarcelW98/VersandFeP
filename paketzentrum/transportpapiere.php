<?php  
session_start();  
  
if(isset($_SESSION['benutzer']))
{  
    $Werkstatt = 1;
    $Schicht = 0;
    $Admin = 0;
    $buero = 0;    
} else 

if(isset($_SESSION['buero']))
{  
    $Werkstatt = 0;
    $Schicht = 0;
    $Admin = 0;
    $buero = 1;    
} else

if(isset($_SESSION['schichtfuehrer'])) {
    $Werkstatt = 0;
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
    $Werkstatt = 0;
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
    <title>Transportpapiere erstellen</title>  
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
<div class="bg-white container-fluid col-md-6 bg-light rounded text-center">   
  <a><img src="view/media/Logo_groß.png" width="620px" height="150px" class="d-inline-block rounded img-fluid" alt="LOGO"/><h1>Transportpapiere erstellen</h1></a>
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
	 
<div class="row">

<!-- Dienstleister -->
<div class="form-group center-block text-center col-md-6">
	<label><strong>Dienstleister</strong><span class="text-danger">*</span></label>
	  <select id="input_Dienstleister" name="input_Dienstleister" ng-model="insert.input_Dienstleister" class="form-control">
	  <option value="" selected disabled>Bitte Auswählen</option>
      <option ng-click="insertData()" value="TNT">TNT</option>
      <option ng-click="insertData()" value="UPS">UPS</option>
      <option ng-click="insertData()" value="DHL Express">DHL Express</option>
      <option ng-click="insertData()" value="Schenker">Schenker</option>
      <option ng-click="insertData()" value="Sonstige">Sonstige</option>
      </select>
      <span class="bg-danger text-white" ng-show="errordienstleister">{{errordienstleister}}</span>
	</div>



<!-- Tracking Nr. -->
<div class="form-group center-block text-center col-md-6">
		<label><strong>Tracking Nr.</strong><span class="text-danger">*</span></label>
        <label><font size="2">Nur bei Paketdienstleister eingeben!</font></label>
      	<input id="input_Tracking" name="input_Tracking" ng-click="Track()" ng-model="insert.input_Tracking" class="form-control">
        <span class="bg-danger text-white" ng-hide="insert.input_Tracking" ng-show="errortracking">{{errortracking}}</span>
    </div>

</div>


<div class="row">

<!-- Bearbeiter -->
<div class="form-group center-block text-center col-md-6">
		<label><strong>Bearbeiter (VKS Nr.:)</strong><span class="text-danger">*</span></label>
      	<select id="input_transbearbeiter" name="input_transbearbeiter" ng-model="insert.input_transbearbeiter" class="form-control">
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
        <span class="bg-danger text-white" ng-hide="insert.input_transbearbeiter" ng-show="errortransbearbeiter">{{errortransbearbeiter}}</span>
    </div>	

</div>

     <div class="form-group col-md-12 text-center">
	 <br />
      <input type="submit" id="insert" name="insert"  class="btn rb-button rb-button--primary btn-block"  value="Auftrag speichern" />	  
     </div>
     <div class="col-md-12 text-left">
	 <button class="btn btn-danger rb-button-sm" onclick="javascript:document.getElementById('barcode_scantrans').focus()" ng-click="reset()" type="button">Eingabe zurücksetzen</button>
<?php 
if($Schicht == 1)
{   
    echo "<a href='transportpapiereedit.php'><button type='button' style='position: absolute; right: 235;'class='btn btn-dark rb-button-sm'>Transportpapiere korrigieren</button></a>";   
} 

if($Admin == 1)
{
    echo "<a href='transportpapiereedit.php'><button style='position: absolute; right: 235;'class='btn btn-dark rb-button-sm' type='button'>Transportpapiere korrigieren</button></a>";     
} 
?>
     </div>    
    </form>
   </div>
  </div>

  <br />

<!-- Arbeitsvorat Anfang-->
<div class="row"> 
<div class="container-fluid col-md-11 text-center border rounded" style="width:700px; background-color: #efeff0;"> 
<div class="table-scrol">  
  <h2>Arbeitsvorrat zum Transportpapiere erstellen</h2> 	  
<div class="table-responsive bg-light"> <!--this is used for responsive display in mobile and other devices-->
  <table id="Arbeitsvorrat" class="table table-bordered table-hover table-striped" style="table-layout: fluid">  
      <thead>
      <tr>
          <th>Auftragsnummer</th>
          <th>Datum Bereitstellung</th>
          <th>Zeit Bereitstellung</th>
          <th>Lieferschein</th>
          <th>Weitere Bearbeitung</th>
          <th>Länderhinweis</th>
          <!-- <th>Bearbeiter VKS Bereitstellung</th> -->
          <th>Priorität</th>
          
      </tr>  
      </thead>  

      <?php  
      include("database/db_conection.php");
      if($buero == 1)
      {
      $view_arbeitsvorrat_query="select * FROM versendungen WHERE Status_Bereitstellung='1' && Weitere_Bearbeitung='Versandbüro' && Status_Transportpapiere='' && Status_Storno='' && Status_Klaerung='' ORDER by Prioritaet_Wareneingang='eilig' DESC, STR_TO_DATE(Datum_Bereitstellung, '%d.%m.%Y') ASC, Zeit_Bereitstellung ASC";
      } else 
      if($Werkstatt == 1) {
        $view_arbeitsvorrat_query="select * FROM versendungen WHERE Status_Bereitstellung='1' && Weitere_Bearbeitung='W011927' && Status_Transportpapiere='' && Status_Storno='' && Status_Klaerung='' ORDER by Prioritaet_Wareneingang='eilig' DESC, STR_TO_DATE(Datum_Bereitstellung, '%d.%m.%Y') ASC, Zeit_Bereitstellung ASC";    
      } else {    
      $view_arbeitsvorrat_query="select * FROM versendungen WHERE Status_Bereitstellung='1' && Status_Transportpapiere='' && Status_Storno='' && Status_Klaerung='' ORDER by Prioritaet_Wareneingang='eilig' DESC, STR_TO_DATE(Datum_Bereitstellung, '%d.%m.%Y') ASC, Zeit_Bereitstellung ASC"; 
      }
      $run=mysqli_query($dbcon,$view_arbeitsvorrat_query);//here run the sql query.  

      while($row=mysqli_fetch_array($run)) //while look to fetch the result and store in a array $row.  
      {  
          $id=$row[0];
          $referenz=$row[1];
          $prioW=$row[7];
          $datumT=$row[16];
          $zeitT=$row[17];
          $lieferscheinT=$row[18];
          $wbearbT=$row[19];
          $landerT=$row[20]; 
          $bearbT=$row[21]; 
          $gewB=$row[22]; 
          
          
      ?>  
      <tr>  
<!--here showing results in the table --> 
          <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><a class="Auftragsnummer" href="detail.php?id=<?php echo $referenz;?>"  style="color: black"> <?php echo $referenz;?> </a></td>
          <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $datumT;  ?></td>
          <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $zeitT;  ?></td>
          <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $lieferscheinT;  ?></td>
          <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $wbearbT;  ?></td> 
          <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $landerT;  ?></td>
          <!-- <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $bearbT;  ?></td> -->
          <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $prioW;  ?></td> 
                  	 	
      </tr>
      <?php } 
      mysqli_close($dbcon);
      ?>  
  </table>  
      </div>  
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

// Eingabeform prüfung und in Datenbank speichern
var app = angular.module("myapp", []);
	app.controller("formcontroller", function($scope, $http){
 $scope.insert = {};
 $scope.insertData = function(){
  $http({
   method:"POST",
   url:"function/transportpapiere.php",
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
    $scope.insert.input_transbearbeiter="";

    $scope.errordienstleister="";
    $scope.errortracking="";
    $scope.errortransbearbeiter="";
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
    $scope.insert.input_transbearbeiter="";
    $scope.errortracking = "";
    $scope.errortransbearbeiter = data.error4.input_transbearbeiter;
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
    $scope.errortransbearbeiter = data.error4.input_transbearbeiter;
    $scope.successInsert="";

    }
   }

   else


// Fehlerbehandlung - Bearbeiter leer  
   if(data.error4)
   {
    if(data.error4.input_transbearbeiter > "") {
    $scope.errorbarcodescan= ""; 
    $scope.errortransbearbeiter = data.error4.input_transbearbeiter;
    document.getElementById('input_transbearbeiter').focus();
    $scope.errordienstleister="";
    $scope.errortracking="";
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
    $scope.errortransbearbeiter="";
    $scope.prio="";
    $scope.successInsert = data.message;
    document.getElementById('barcode_scantrans').focus();
    $( "#Arbeitsvorrat" ).load("transportpapiere.php #Arbeitsvorrat");
   }

  });
 };

 // Eingabeform zurücksetzen
 $scope.reset = function() {
	 
			  $scope.successInsert="";
			  $scope.insert.barcode_scantrans="";
              $scope.insert.input_Dienstleister="";
			  $scope.insert.input_Tracking="";
              $scope.insert.input_transbearbeiter="";
			  
			  $scope.errorbarcodescan="";
			  $scope.errordienstleister="";
              $scope.errortracking="";
              $scope.errortransbearbeiter="";
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
// Wenn "Enter" in Dienstleister dann button Klick
$(document).ready(function() {
    $("#input_Dienstleister").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
});
</script>

<script>
// Wenn "Enter" in Bearbeiter dann button Klick
$(document).ready(function() {
    $("#input_transbearbeiter").keyup(function(event) {
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


