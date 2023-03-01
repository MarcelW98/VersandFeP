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
    <title>Auftrag verpacken</title>  
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
<div class="bg-white container-fluid col-md-6 bg-light rounded text-center">   
  <a><img src="view/media/Logo_groß.png" width="620px" height="150px" class="d-inline-block rounded img-fluid" alt="LOGO"/><h1>Auftrag verpacken</h1></a>
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
	 
<div class="row">

<!-- Bearbeiter -->
    	<div class="form-group center-block text-center col-md-6">
		<label><strong>Bearbeiter (VKS Nr.:)</strong><span class="text-danger">*</span></label>
          <select id="input_Verpackbearbeiter" name="input_Verpackbearbeiter" ng-model="insert.input_Verpackbearbeiter" class="form-control">
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
        <span class="bg-danger text-white" ng-hide="insert.input_Verpackbearbeiter" ng-show="errorverpackbearbeiter">{{errorverpackbearbeiter}}</span>
    </div>
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
     <?php

if($Schicht == 1)
{ 
    echo "<a href='verpackenedit.php'><button style='position: absolute; right: 235;'class='btn btn-dark rb-button-sm' type='button'>Verpackung korrigieren</button></a>";
    echo "<a href='verpackenreset.php'><button style='position: absolute; right: 15;' class='btn btn-warning rb-button-sm' type='button'>Status zurücksetzen</button></a>";    
} 

if($Admin == 1)
{ 
    echo "<a href='verpackenedit.php'><button style='position: absolute; right: 235;'class='btn btn-dark rb-button-sm' type='button'>Verpackung korrigieren</button></a>";
    echo "<a href='verpackenreset.php'><button style='position: absolute; right: 15;' class='btn btn-warning rb-button-sm' type='button'>Status zurücksetzen</button></a>";    
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
    <h2>Arbeitsvorrat zum Verpacken</h2> 	  
  
<div class="table-responsive bg-light"> <!--this is used for responsive display in mobile and other devices-->
    <table id="Arbeitsvorrat" class="table table-bordered table-hover table-striped" style="table-layout: fluid">  
        <thead>
        <tr>
			<th>Auftragsnummer</th>
            <th>Datum Wareneingang</th>
			<th>Zeit Wareneingang</th>
            <th>Auftragsart</th>
            <th>Geschäftsbereich</th>
            <!-- <th>Bearbeiter VKS Wareneingang</th> -->
            <th>Hinweis</th>
            <th>Priorität</th>
        </tr>  
        </thead>  
  
        <?php  
        include("database/db_conection.php");  
        $view_arbeitsvorrat_query="select * FROM versendungen WHERE Status_Verpacken='' && Status_Klaerung='' && Status_Storno='' ORDER by Prioritaet_Wareneingang='eilig' DESC, ID ASC";//select query for viewing users.  
        $run=mysqli_query($dbcon,$view_arbeitsvorrat_query);//here run the sql query.  
  
        while($row=mysqli_fetch_array($run)) //while look to fetch the result and store in a array $row.  
        {  
            $id=$row[0];
            $referenz=$row[1];
            $datumW=$row[2];
            $zeitW=$row[3];
            $aufaW=$row[4]; 
            $gbW=$row[5];
            $hinweisW=$row[6]; 
            $bearbW=$row[8];
            $prioW=$row[7]; 
            
        ?>  
        <tr>  
<!--here showing results in the table --> 
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><a class="Auftragsnummer" href="detail.php?id=<?php echo $referenz;?>"  style="color: black"> <?php echo $referenz;?> </a></td>
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $datumW;  ?></td>
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $zeitW;  ?></td>
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $aufaW;  ?></td>
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $gbW;  ?></td>
            <!-- <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $bearbW;  ?></td> -->
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $hinweisW;  ?></td>
            <td <?php if($prioW == "eilig") { echo ' style="font-weight:bold;" id="spezial"'; }   ?>><?php echo $prioW;  ?></td>         	 	
        </tr>
        <?php } 
        mysqli_close($dbcon);
        ?>  
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
var app = angular.module("myappver", []);
	app.controller("formcontrollerver", function($scope, $http){
 $scope.insert = {};
 $scope.insertData = function(){
  $http({
   method:"POST",
   url:"function/verpacken.php",
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
    $scope.errorverpackbearbeiter="";
    $scope.successInsert="";
    $scope.insert.input_Verpackbearbeiter="";
    $scope.insert.input_l="";
    $scope.insert.input_b="";
    $scope.insert.input_h="";
    $scope.insert.input_g="";
    $scope.prio="";
   }
   else

// Fehlerbehandlung - Bearbeiter leer  
if(data.error2)
   {
    if(data.error2.input_Verpackbearbeiter > "") 
    {
    $scope.errorbarcodescan= ""; 
    $scope.errorverpackbearbeiter = data.error2.input_Verpackbearbeiter;
    document.getElementById('input_Verpackbearbeiter').focus();
    $scope.errorlaenge = data.error3.input_l;
    $scope.errorbreite = data.error4.input_b; 
    $scope.errorhoehe = data.error5.input_h; 
    $scope.errorgewicht = data.error6.input_g; 
    $scope.successInsert="";

    }
   }

   else

   // Fehlerbehandlung - Länge leer  
if(data.error3)
   {
    if(data.error3.input_l> "") 
    {
    $scope.errorbarcodescan= ""; 
    $scope.errorverpackbearbeiter = "";
    $scope.errorlaenge = data.error3.input_l;
    document.getElementById('input_l').focus();
    $scope.errorbreite = data.error4.input_b; 
    $scope.errohoehe = data.error5.input_h; 
    $scope.errorgewicht = data.error6.input_g; 
    $scope.successInsert="";

    }
   }

   else

   // Fehlerbehandlung - Breite leer  
   if(data.error4)
   {
    if(data.error4.input_b> "") 
    {
    $scope.errorbarcodescan= ""; 
    $scope.errorverpackbearbeiter = "";
    $scope.errorlaenge = ""; 
    $scope.errorbreite = data.error4.input_b;
    document.getElementById('input_b').focus(); 
    $scope.errorhoehe = data.error5.input_h; 
    $scope.errorgewicht = data.error6.input_g; 
    $scope.successInsert="";

    }
   }

   else

      // Fehlerbehandlung - Höhe leer  
    if(data.error5)
   {
    if(data.error5.input_h> "") 
    {
    $scope.errorbarcodescan= ""; 
    $scope.errorverpackbearbeiter = "";
    $scope.errorlaenge = ""; 
    $scope.errorbreite = "";
    $scope.errorhoehe = data.error5.input_h; 
    document.getElementById('input_h').focus(); 
    $scope.errorgewicht = data.error6.input_g; 
    $scope.successInsert="";

    }
   }

   else

    // Fehlerbehandlung - Gewicht leer  
    if(data.error6)
   {
    if(data.error6.input_g> "") 
    {
    $scope.errorbarcodescan= ""; 
    $scope.errorverpackbearbeiter = "";
    $scope.errorlaenge = ""; 
    $scope.errorbreite = "";
    $scope.errorhoehe = "";
    $scope.errorgewicht = data.error6.input_g;  
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
    $scope.errorverpackbearbeiter="";
    $scope.prio="";
    $scope.successInsert = data.message;
    document.getElementById('barcode_scanver').focus();
    $( "#Arbeitsvorrat" ).load("verpacken.php #Arbeitsvorrat");	
   }

  });
 };

  // Eingabeform zurücksetzen
 $scope.reset = function() {
	 
			$scope.successInsert="";
			$scope.insert.barcode_scanver="";
			$scope.insert.input_Verpackbearbeiter="";
            $scope.insert.input_l="";
            $scope.insert.input_b="";
            $scope.insert.input_h="";
            $scope.insert.input_g="";
			
            

			$scope.errorbarcodescan="";
            $scope.prio="";
            $scope.errorverpackbearbeiter="";
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
    $("#input_Verpackbearbeiter").keyup(function(event) {
if (event.keyCode == 13) {
    $("#insert").click();
}
});
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

<style type="text/css">
<!--
   #spezial
{
      background-color: #FA5858;
}
-->
</style>

