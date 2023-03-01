
<html>
<head>
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

 </head>

<style>

  .col:hover{
    background: #e1e1e1;
   border: 1px solid #d0d0d0;
   
   
  }
  

  .imgFlag{
    height: 50px;
    width: 50px;
    border-radius: 100px; 
    float: left;
  }
  @media (min-width: 1200px) {
    .container{
        max-width: 1500px;
    } 
}

@media (min-height: 980px) {
   .form-control {
    min-height:calc(1.5em + (1rem + 2px));padding:.5rem 1rem;font-size:1.25rem;border-radius:.3rem;
  }
  .big-checkbox {
  width: 33px; height: 33px;
  }
}


a{
    text-decoration: none;
    color: black;
}




</style>

<body class="bg" > 
<header style="background-color:  #F5F5F5" >

    <img src="../bilder/colorbar.png" alt="colorbar" class="img-fluid" style="width:100%; height:9px; " />
    <nav class="navbar navbar-light bg-faded">
        <a class="navbar-brand align-top">
            <img src="../bilder/BoschLogoNavColored.png" width="180" class="d-inline-block rounded" alt="Bosch Icon" />
            Versand@FeP</a>

        
        <div class="position-absolute top-100 start-50 translate-middle">
            <h1 style="margin-bottom: 50px;" id="ueberschrift"><b>Fahreranmeldung </b></h1>
        </div>
        
      
        <div  style="margin-right: 60px; margin-top: 10px"><h5 id="zeit"></h5></div>
    </nav>
</header> 

<br>



<form action="insert_fahrerdaten.php" style="width: 600px; margin: auto;" name="fahrerdataform" id="fahrerdataform"  method="post">
<p id="infoText" >Um die Verladung antreten zu können, müssen Sie sich mit dem untenstehenden Formular anmelden. Danach werden Sie zeitnah von uns aufgerufen.</p>
 <div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon1"><b>Anmeldung Uhrzeit:</b></span>
  <input type="text" class="form-control " id="zeitForm"    aria-describedby="basic-addon1" disabled readonly>
</div>
<br>
<div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon4"><b>Name Fahrer:</b> </span>
  <input type="text" class="form-control" name="fahrerInput" id="fahrerInput"  aria-describedby="basic-addon4" >
</div>
<br>
<div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon2"><b>Kennzeichen:</b></span>
  <input type="text" class="form-control "   name="kennezeichenInput" id="kennezeichenInput" aria-describedby="basic-addon2" >
</div>
<br>
<div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon3"><b>Spedition:&nbsp&nbsp&nbsp&nbsp&nbsp   </b></span>
  <input type="text" class="form-control " name="speditionInput" id="speditionInput" list="spediOptions"  aria-describedby="basic-addon3" >
  
  <datalist  id="spediOptions">
  
  <option value="Agility">Agility</option>
      <option value="Barsan">Barsan</option>
      <option value="CEVA">CEVA</option>
      <option value="Cosco">Cosco</option>
      <option value="CPD">CPD</option>
      <option value="DHL-Express">DHL-Express</option>
      <option value="DHL-Global">DHL-Global</option>
      <option value="DSV">DSV</option>
      <option value="ERA">ERA</option>
      <option value="FCM">FCM</option>
      <option value="Große Vehne">Große Vehne</option>
      <option value="Hellman">Hellman</option>
      <option value="K&N">K&N</option>
      <option value="KWE">KWE</option>
      <option value="LGI">LGI</option>
      <option value="LKW Walter">LKW Walter</option>
      <option value="Nippon">Nippon</option>
      <option value="Patinter">Patinter</option>
      <option value="Robinson">Robinson</option>
      <option value="Rüdiger">Rüdiger</option>
      <option value="Schenker">Schenker</option>
      <option value="TMC">TMC</option>
      <option value="TNT">TNT</option>
      <option value="UPS">UPS</option>
      <option value="Wackler">Wackler</option>
</datalist>
</div>
<br>
<div class="input-group mb-3">
  <span class="input-group-text" id="basic-addon6"><b>Referenznummer (BOLOG):</b></span>
  <input type="text" class="form-control " name="bologInput" id="bologInput" aria-describedby="basic-addon2" >
  <button class="btn btn-outline-secondary" type="button" onclick="hilfeModal()"; id="buttonHilfe">Hilfe</button>
</div>
<br>
<div class="input-group mb-3">
<div class="input-group-text ">
  <span  id="basic-addon5"><b>Sonderfahrt: </b> </span>
    <input class="form-check-input big-checkbox" style="margin: 0px 0px 0px 20px;" value="Sonderfahrt" name="flexCheckChecked" id="flexCheckChecked" type="checkbox" aria-describedby="basic-addon5" >
  </div>
  
</div>
  
  <br>
  
  <button type="button" onclick="pflichtfelder()" style="margin-left: 31%;" id="buttonAnmelden" name="buttonAnmelden" class="btn btn-primary">Anmelden</button>
  <button type="button"  onclick="zuruecksetzen()" id="buttonZuruecksetzen" style="margin-left: 10px;" class="btn btn-secondary">Zurücksetzen</button>
  
</form>


<?php
      include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/fahreranmeldung/modals/sprachauswahl_modals.php");
      ?>


<br>
<br>
<div class="container ">
  

<div class="row row-cols-sm-2 row-cols-md-3 row-cols-lg-4 row-cols-xl-4 row-cols-xxl-6 g-4" style="margin-left: 6em">


  <div class="col  p-3" onclick="deutsch()" >
      <img class="imgFlag" src="../bilder/de.png"  alt="deutsch" >
      <h3 style="margin: 8px; ">&nbsp deutsch</h3>
    </div>

  <div class="col  p-3" onclick="englisch()">
      <img class="imgFlag" src="../bilder/gb.png" alt="englisch">
      <h3 style="margin: 8px; ">&nbsp english</h3>
  </div>
  
  <div class="col  p-3" onclick="ungarisch()">
      <img class="imgFlag" src="../bilder/hu.png"  alt="ungarisch">
      <h3 style="margin: 8px; "> &nbsp magyar</h3>
  </div>

  <div class="col   p-3" onclick="tschechisch()">
      <img class="imgFlag" src="../bilder/cz.png"  alt="tschechisch">
      <h3 style="margin: 8px; ">&nbsp česky</h3>
  </div>

  <div class="col   p-3" onclick="spanisch()">
      <img class="imgFlag" src="../bilder/es.png"  alt="spanisch">
      <h3 style="margin: 8px; ">&nbsp español</h3> 
  </div>

  <div class="col   p-3" onclick="französisch()">
      <img class="imgFlag" src="../bilder/fr.png"  alt="französisch">
      <h3 style="margin: 8px; ">&nbsp français</h3>
  </div>

  <div class="col  p-3" onclick="griechisch()">
      <img class="imgFlag" src="../bilder/gr.png"  alt="griechisch">
      <h3 style="margin: 8px; ">&nbsp eλληνικά</h3>  
  </div>

  <div class="col  p-3" onclick="russisch()">
      <img class="imgFlag" src="../bilder/ru.png"  alt="russisch">
      <h3 style="margin: 8px; ">&nbsp pусский</h3>   
</div>
  
  <div class="col   p-3" onclick="italienisch()">
      <img class="imgFlag" src="../bilder/it.png"  alt="italienisch">
      <h3 style="margin: 8px; ">&nbsp italiano</h3>
  </div>

  <div class="col  p-3" onclick="polnisch()">
      <img class="imgFlag" src="../bilder/pl.png"  alt="polnisch">
      <h3 style="margin: 8px; ">&nbsp polski</h3>
  </div>

  <div class="col   p-3" onclick="türkisch()">
      <img class="imgFlag" src="../bilder/tr.png"  alt="türkisch">
      <h3 style="margin: 8px; ">&nbsp türkçe</h3>
  </div>

  <div class="col  p-3" onclick="rumänisch()">
      <img class="imgFlag" src="../bilder/ro.png"  alt="rumänisch">
      <h3 style="margin: 8px; ">&nbsp română</h3>
  </div>
</div>
</div>

<br>
<br>

<footer class="footer fixed-bottom"  >
  <!-- copyright -->
  <div class="footer-copyright   py-3">
  <p class="position-absolute top-50 start-50 translate-middle"> 2022 FeP/LOM3:
    <a href="" target="_blank" rel="noopener"> #logistics</a>
    <span class="py-3">&#9743;</span>&nbsp; Support-Hotline: <a href="tel:+4971181129357">+49(711)811-22607</a> &nbsp; &nbsp; &nbsp;</p>
  </div>
  <img src="../bilder/colorbar.png" alt="colorbar" class="img-fluid" style="height:8px; width:100% " />
</footer>
</body>

<?php
  include("scripts/sprachauswahl_js.php");
  ?>
</html>
