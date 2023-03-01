
<?php
include("database/ssi_data.php")  
?>

<html>  
<head lang="en">  
  <meta charset="UTF-8">
  <link rel="shortcut icon" href="view/media/favicon.ico">
  <link type="text/css" rel="stylesheet" href="cssBootstrap\bootstrap.css">
	<link rel="stylesheet" href="cssBootstrap/bootstrap.min.css">
	<link rel="stylesheet" href="cssBootstrap/sticky-footer-navbar.css">
	<link rel="stylesheet" href="cssBootstrap/rb_design.css">
	<script src="js/jquery.min.js"></script>
  <script src="js/angular.min.js"></script>
  <title>Tracking@FeP</title> 


  
  </head>  
  

<!-- <body class="bg"> -->
 <body >
 <header class="bg-light fixed-top">  
	<img src="view/media/colorbar.png" alt="colorbar" class="img-fluid" style="width:120%"/> 
      <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
		    <a class="navbar-brand align-top">
                <img src="view/media/BoschLogoNavColored.png" width="180" height="40" class="d-inline-block rounded" alt="Bosch Icon"/>
  
</header>   
 

<br />
<br />
<br />

 <main role="main" class="container text-center"> 
<div class="container-fluid col-md-12 text-center">  
    <div class="row">  
        <div class="container col-md-12 bg-white rounded text-center">  
            <div class="login-panel panel panel-success">  
                <div class="panel-heading">
				          <a><img src="view/media/Logo_groß.png" width="600" height="300" class="d-inline-block rounded img-fluid" alt="LOGO"/><h3>Personeninformationen <?php echo $displayName ?></h3></a>
                <br /> 
                
                   
					        <!-- <h5>Bitte Referenznummer zum Suchen eingeben oder scannen!</h5> -->
                      <br />
                      <br />  
                      <form action="index1.php" method="post" >
                        
                                               
                       <input type ="text" name="testinput" id="testinput" autofocus></input>                          
                       <input type="submit" value="Suchen" name="absenden" id="absenden"></button>
                      </form>
                                           
                      <span class="bg-danger text-white" style=" margin-right: 7.5%" ><?php echo $UserNotfound?></span>
<br>
<br>
<div id= "testtable">
                      <table class ="table table-striped" id="hallo" >
                <?php echo $newTableRow ?>    
              </table>
</div>
            </div>  
        </div>  
    </div>  
</div>

</main>


<?php
include("templates/footer.inc.php")  
?>
 
</body>  

</html> 


<script>
$(document).ready(function(){
  var bannerData = '<?php echo $ALL ?>';
console.log(JSON.stringify(bannerData));

});
</script>

