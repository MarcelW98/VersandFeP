<?php  
session_start();  
  
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


<html>  
<head lang="en">   
    <meta charset="UTF-8">
    <link rel="shortcut icon" href="view/media/favicon.ico">  
    <link type="text/css" rel="stylesheet" href="css/bootstrap.css">
	  <link rel="stylesheet" href="css/bootstrap.min.css">
	  <link rel="stylesheet" href="css/sticky-footer-navbar.css">
    <link rel="stylesheet" href="css/rb_design.css">
	  <script src="js/jquery.min.js"></script>
    <script src="js/angular.js"></script>	
    <title>Verwaltung Paketzentrum</title>  
</head>   

<body class="bg">
<script src="js/bootstrap.min.js"></script>	

<header class="bg-light fixed-top">
<!-- Das ist der Header -->  
	<img src="view/media/colorbar.png" alt="colorbar" class="img-fluid" style="width:100%"/> 
      <nav class="navbar navbar-light bg-faded">
		<a class="navbar-brand align-top">
            <img src="view/media/BoschLogoNavColored.png" width="200" height="45" class="d-inline-block rounded" alt="Bosch Icon"/>
            Versand Werk Feuerbach&nbsp &nbsp &nbsp &nbsp <button class="align-self-end btn rb-button rb-button--primary" onclick="location.href = 'paketzentrum.php'">zurück zur Übersicht</button></a> 
<?php 
if($Admin == 1)
{
    echo "<a><center><strong>Sie sind als Administrator eingeloggt</strong><br>(nach 10 Minuten Inaktivität werden Sie automatisch abgemeldet.)</center></a>";           
} 
?>            
            
            
            <button type="button" class="btn btn-danger rb-button-sm" onclick="location.href = 'Logout.php'">Abmelden</button> 
      </nav>
</header> 
<br />
<br />
<br />
<br />
<main>
<!--Alle Benutzer anzeigen Anfang-->
<div class="row"> 
<div class="container-fluid col-md-6 text-center bg-light rounded"> 
<div class="table-scrol">  
    <h1>Alle Benutzer</h1>  
  
<div class="table-responsive bg-light"><!--this is used for responsive display in mobile and other devices-->  
        <table class="table table-bordered table-hover table-striped" style="table-layout: fixed">  
        <thead>  
  
        <tr>    
            <th>Benutzername Name</th>
			      <th>Benutzer Rolle</th>
            <th><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myBenutzerModal">Benutzer Hinzufügen</button></th>
        </tr>  
        </thead>  
  
        <?php  
        include("database/db_conection.php");  
        $view_users_query="select * from user"; //select query for viewing users.  
        $run=mysqli_query($dbcon,$view_users_query); //here run the sql query.  
  
        while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
        {  
            $user_id=$row[0];  
            $user_name=$row[1];   
            $user_typ=$row[3];
		?>  
        <tr>  
<!--here showing results in the table -->  
             
            <td><?php echo $user_name;  ?></td>
			<td><?php echo $user_typ;  ?></td>			
            <td><a href="user_delete.php?del_user=<?php echo $user_id ?>"><button class="btn btn-danger btn-sm">Löschen</button></a> <a></a> <a><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myBenutzereditModal" data-1="<?php echo $user_id ?>">Rolle ändern</button></a></td>	
        </tr>
        <?php } 
        mysqli_close($dbcon);
        ?>  
    </table>  
        </div>  
</div>  
</div> 
</div>
<!--Alle Benutzer anzeigen Ende -->

<!-- Modal Benutzer-->
  <div class="modal fade" id="myBenutzerModal" role="dialog">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Benutzer hinzufügen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="panel-body">  
                    <form role="form" method="post" action="user_hinz.php">  
                        <fieldset>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Benutzername:" name="username" type="text" autofocus required>  
                            </div>
							<div class="form-group">  
                                <input class="form-control" placeholder="Passwort:" name="passw" type="password" autofocus required>  
                            </div> 
                            <div class="form-group">
                            <label><strong>Rolle?</strong><span class="text-danger">*</span></label>
	                        <select type="text" name="rolle"  class="form-control" autofocus required>
	                            <option value="" selected disabled>Bitte Auswählen</option>
                                <option value="benutzer">Benutzer</option>
                                <option value="buero">Büro</option>
                                <option value="schichtfuehrer">Schichtführer</option>
                                <option value="admin">Admin</option>
                            </select>   
                            </div> 							
						<input class="btn btn-primary btn-sm" type="submit" value="Hinzufügen" name="name" >
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        </fieldset>  
                    </form>  
        </div> 
      </div>
    </div>
  </div>
</div>
<!-- Modal Benuter  Ende -->

<!-- Modal Benutzeredit -->
<div class="modal fade" id="myBenutzereditModal" role="dialog">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Benutzer Rolle ändern</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="panel-body">  
                    <form role="form" method="post" action="user_edit.php"> 
                    <input type="hidden" name="usereditid" id="modal-data1" />
                        <fieldset>  
                            <div class="form-group">
                            <label><strong>Rolle?</strong><span class="text-danger">*</span></label>
	                        <select type="text" name="rolle"  class="form-control" autofocus required>
	                            <option value="" selected disabled>Bitte Auswählen</option>
                                <option value="benutzer">Benutzer</option>
                                <option value="buero">Büro</option>
                                <option value="admin">Admin</option>
                                <option value="schichtfuehrer">Schichtführer</option>
                            </select>   
                            </div> 							
						<input class="btn btn-primary btn-sm" type="submit" value="Ändern" name="name" >
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        </fieldset>  
                    </form>  
        </div> 
      </div>
    </div>
  </div>
</div>
<!-- Modal Benuteredit  Ende -->

<div id="vkslist"><br /><br /><br /><br /><br /></div>
<!-- VKS MA Anfang-->
<div class="row"> 
<div class="container-fluid col-md-4 text-center bg-light rounded"> 
<div class="table-scrol">  
    <h2>VKS Mitarbeiter</h2> 	  
  
<div class="table-responsive bg-light"> <!--this is used for responsive display in mobile and other devices-->
    <table class="table table-bordered table-hover table-striped" style="table-layout: fluid">  
        <thead>
        <tr>
            <th>VKS Nummer</th>
            <th>VKS Name</th>
            <th><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myVKSModal">Hinzufügen</button></th>
        </tr>  
        </thead>  
  
        <?php  
        include("database/db_conection.php");  
        $view_vks_query="select * FROM vks ORDER by VKS_Nummer ASC";//select query for viewing users.  
        $run=mysqli_query($dbcon,$view_vks_query);//here run the sql query.  
  
        while($row=mysqli_fetch_array($run)) //while look to fetch the result and store in a array $row.  
        {  
            $id=$row[0];  
            $VKSNummer=$row[1];
            $VKSName=$row[2]; 	  	
        ?>  
        <tr>  
<!--here showing results in the table -->  
             
            <td><?php echo $VKSNummer;  ?></td>
            <td><?php echo $VKSName;  ?></td>
            <td><a href="vks_delete.php?del_vks=<?php echo $id ?>"><button class="btn btn-danger btn-sm">Löschen</button></a><a></a> <a><button class="btn btn-warning btn-sm" data-toggle="modal" data-target="#myvkseditModal" data-2="<?php echo $id ?>">MA Name ändern</button></a></td>	 	
        </tr>
        <?php } 
        mysqli_close($dbcon);
        ?>  
    </table>  
        </div>  
	</div>  
</div> 
</div>
<!--VKS MA Dropdown Ende -->

<!-- Modal VKS MA-->
  <div class="modal fade" id="myVKSModal" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">VKS Mitarbeiter hinzufügen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="panel-body">  
                    <form role="form" method="post" action="vks_hinz.php">  
                        <fieldset>  
                            <div class="form-group row">
                            <div class="col-sm-3">  
                                <input type="number" min="0" max="99" class="form-control" placeholder="VKS_Nr." name="VKS_Nummer" autofocus required ></div>
                                <div>&nbsp &nbsp</div>
                              <div class="col-xs-3">
                                <input class="form-control" placeholder="VKS_Name" name="VKS_Name" type="text" autofocus required >    
                            </div>  
                        </fieldset>
                        <input class="btn btn-primary btn-sm" type="submit" value="Hinzufügen" name="vks" >
						            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>  
                    </form>  
        </div> 
      </div>
    </div>
  </div>
</div>
<!-- Modal VKS MA Ende -->

<!-- Modal VKS MA edit -->
<div class="modal fade" id="myvkseditModal" role="dialog">
  <div class="modal-dialog  modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">VKS Mitarbeiter ändern</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="panel-body">  
                    <form role="form" method="post" action="vks_edit.php"> 
                    <input type="hidden" name="vkseditid" id="modal-data2" />
                        <fieldset>  
                        <div class="form-group row">
                              <div class="center col-xs-3">
                                <input class="form-control" placeholder="VKS_Name" name="VKS_Name" type="text" autofocus required >    
                            </div>							
                        </fieldset>
                        <input class="btn btn-primary btn-sm" type="submit" value="Ändern" name="name" >
						            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button> 
                    </form>  
        </div> 
      </div>
    </div>
  </div>
</div>
<!-- Modal VKS MA edit  Ende -->



<div id="auftraglist"><br /><br /><br /><br /><br /></div>
<!--Auftragsart Dropdown Anfang-->
<div class="row"> 
<div class="container-fluid col-md-4 text-center bg-light rounded"> 
<div class="table-scrol">  
    <h2>Auftragsart Dropdown Daten</h2> 	  
  
<div class="table-responsive bg-light"> <!--this is used for responsive display in mobile and other devices-->
    <table class="table table-bordered table-hover table-striped" style="table-layout: fluid">  
        <thead>
        <tr>
          <th>Auftragsart</th>
          <th><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myAuftragsartModal">Hinzufügen</button></th>
        </tr>  
        </thead>  
  
        <?php  
        include("database/db_conection.php");  
        $view_auftragsart_query="select * FROM auftragsart";//select query for viewing users.  
        $run=mysqli_query($dbcon,$view_auftragsart_query);//here run the sql query.  
  
        while($row=mysqli_fetch_array($run))//while look to fetch the result and store in a array $row.  
        {  
            $id=$row[0];  
            $Auftragsart=$row[1]; 	
        ?>  
        <tr>  
<!--here showing results in the table -->  
             
            <td><?php echo $Auftragsart;  ?></td>
            <td><a href="auftragsart_delete.php?del_auftragsart=<?php echo $id ?>"><button class="btn btn-danger btn-sm">Löschen</button></a></td>	 	
        </tr>
        <?php } 
        mysqli_close($dbcon);
        ?>  
    </table>  
        </div>  
	</div>  
</div> 
</div>
<!--Auftragsart Dropdown Ende -->

<!-- Modal Auftragsart -->
  <div class="modal fade" id="myAuftragsartModal" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Auftragsart hinzufügen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="panel-body">  
                    <form role="form" method="post" action="auftragsart_hinz.php">  
                        <fieldset>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Auftragsart" name="Auftraga" type="text" autofocus required>  
                            </div>  
						<input class="btn btn-primary btn-sm" type="submit" value="Hinzufügen" name="Auftragsart" >
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        </fieldset>  
                    </form>  
        </div> 
      </div>
    </div>
  </div>
</div>
<!-- Modal Auftragsart Ende -->

<div id="gblist"><br /><br /><br /><br /><br /></div>
<!-- Geschäftbereich Anfang-->
<div class="row"> 
<div class="container-fluid col-md-4 text-center bg-light rounded"> 
<div class="table-scrol">  
    <h2>Geschäftsbereich Dropdown Daten</h2> 	  
  
<div class="table-responsive bg-light"> <!--this is used for responsive display in mobile and other devices-->
    <table  class="table table-bordered table-hover table-striped" style="table-layout: fluid">  
        <thead>
        <tr>
          <th>Geschäftbereich</th>
          <th><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myGBModal">Hinzufügen</button></th>
        </tr>  
        </thead>  
  
        <?php  
        include("database/db_conection.php");  
        $view_gb_query="select * FROM gb";//select query for viewing users.  
        $run=mysqli_query($dbcon,$view_gb_query);//here run the sql query.  
  
        while($row=mysqli_fetch_array($run)) //while look to fetch the result and store in a array $row.  
        {  
            $id=$row[0];  
            $Gesch=$row[1]; 	
        ?>  
        <tr>  
<!--here showing results in the table -->  
             
            <td><?php echo $Gesch;  ?></td>
            <td><a href="gb_delete.php?del_gb=<?php echo $id ?>"><button class="btn btn-danger btn-sm">Löschen</button></a></td>	 	
        </tr>
        <?php } 
        mysqli_close($dbcon);
        ?>  
    </table>  
        </div>  
	</div>  
</div> 
</div>
<!--Auftragsart Dropdown Ende -->

<!-- Modal GB -->
  <div class="modal fade" id="myGBModal" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Geschäftbereich hinzufügen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="panel-body">  
                    <form role="form" method="post" action="gb_hinz.php">  
                        <fieldset>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Geschäftsbereich" name="Geschb" type="text" autofocus required>  
                            </div>  
						<input class="btn btn-primary btn-sm" type="submit" value="Hinzufügen" name="Geschäftsbereich" >
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        </fieldset>  
                    </form>  
        </div> 
      </div>
    </div>
  </div>
</div>
<!-- Modal GB Ende -->


<div id="hinweislist"><br /><br /><br /><br /><br /></div>
<!-- Hinweise Anfang-->
<div class="row"> 
<div class="container-fluid col-md-4 text-center bg-light rounded"> 
<div class="table-scrol">  
    <h2>Hinweis Dropdown Daten</h2> 	  
  
<div class="table-responsive bg-light"> <!--this is used for responsive display in mobile and other devices-->
    <table id="hinweislist" class="table table-bordered table-hover table-striped" style="table-layout: fluid">  
        <thead>
        <tr>
          <th>Hinweise</th>
          <th><button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#myHinweisModal">Hinzufügen</button></th>
        </tr>  
        </thead>  
  
        <?php  
        include("database/db_conection.php");  
        $view_hinweis_query="select * FROM hinweis";//select query for viewing users.  
        $run=mysqli_query($dbcon,$view_hinweis_query);//here run the sql query.  
  
        while($row=mysqli_fetch_array($run)) //while look to fetch the result and store in a array $row.  
        {  
            $id=$row[0];  
            $Hinweis=$row[1]; 	
        ?>  
        <tr>  
<!--here showing results in the table -->  
             
            <td><?php echo $Hinweis;  ?></td>
            <td><a href="hinweis_delete.php?del_hinweis=<?php echo $id ?>"><button class="btn btn-danger btn-sm">Löschen</button></a></td>	 	
        </tr>
        <?php } 
        mysqli_close($dbcon);
        ?>  
    </table>  
        </div>  
	</div>  
</div> 
</div>
<!--Auftragsart Dropdown Ende -->

<!-- Modal Hinweis-->
  <div class="modal fade" id="myHinweisModal" role="dialog">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Hinweis hinzufügen</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="panel-body">  
                    <form role="form" method="post" action="hinweis_hinz.php">  
                        <fieldset>  
                            <div class="form-group">  
                                <input class="form-control" placeholder="Hinweis" name="Hinweis" type="text" autofocus required >  
                            </div>  
						<input class="btn btn-primary btn-sm" type="submit" value="Hinzufügen" name="Geschäftsbereich" >
						<button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Close</button>
                        </fieldset>  
                    </form>  
        </div> 
      </div>
    </div>
  </div>
</div>
<!-- Modal Hinweis Ende -->



</main>
<br />
<br />
<br />

<?php
include("function/footer.php")  
?> 

</body>  
  
</html>

<script>
$('#myBenutzereditModal').on('show.bs.modal', function(event) {
    var $relTrgt = $(event.relatedTarget);
$("#modal-data1").val($relTrgt.attr('data-1'));
});
</script>

<script>
$('#myvkseditModal').on('show.bs.modal', function(event) {
    var $relTrgt = $(event.relatedTarget);
$("#modal-data2").val($relTrgt.attr('data-2'));
});
</script>

