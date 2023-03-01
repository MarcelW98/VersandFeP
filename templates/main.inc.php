<?php
  require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/auth/authguard.php");
  AuthGuard::getInstance()->protect(UserType::ADMIN, UserType::SCHICHT, UserType::BUERO, UserType::WERKSTATT, UserType::MONITOR);
  
?>
<br />
<br />
<br />



<div class="row row-cols-sm-1 row-cols-lg-2 row-cols-xl-3 row-cols-xxl-4">

      
<div class="col">
      
      <div class="card m-3 mb-5 border-0">
        <div class="test34" style="background-image: url(bilder/paket.jpg); background-size: cover; height: 160px;">
          <h2 style="color: white;">Paketzentrum </h2>
        </div>
        <div class="card-footer">
          <a href="paketzentrum/login.php"target="_blank" rel="noopener">
          <button  type="button" class="a-button a-button--primary">
            <div class="a-button__label"> &nbsp Anwendung starten &nbsp<img src="assets/icons/forward-right-double.svg" height="25" width="25"></div>
          </button></a>
        </div>
      </div>
    </div>
    
      <div class="col">
        <div class="card m-3 mb-5 border-0">
          <div class="test34" style="background-image: url(bilder/Laptop.jpg); background-size: cover; height: 160px;">
            <h2 style="color: white;">Lieferboard</h2>
          </div>
          <div class="card-footer">
            <a href="http://fe0vmc1220.de.bosch.com:8080/diglief/app/#!/buero" target="_blank" rel="noopener">
              <button type="button" class="a-button a-button--primary" >
              <div class="a-button__label"> &nbsp Anwendung starten &nbsp<img src="assets/icons/forward-right-double.svg" height="25" width="25"></div>
            </button></a>
          </div>
        </div>
      </div>
      
      <div class="col">
        <div class="card m-3 mb-5 border-0">
          <div class="test34" style="background-image: url(bilder/transporter.jpg); background-size: cover; height: 160px; filter: brightness(40%);">
            <h2 style="color: white;">Avisierung</h2>
          </div>
          <div class="card-footer">
            <button type="button" class="a-button a-button--primary" disabled>
              <div class="a-button__label"> &nbsp Anwendung starten &nbsp<img src="assets/icons/forward-right-double.svg" height="25" width="25"></div>
            </button>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card m-3 mb-5 border-0">
          <div class="test34" style="background-image: url(bilder/LKW.jpg); background-size: cover; height: 160px; ">
            <h2 style="color: white;">Speditionsliste</h2>
          </div>
          <div class="card-footer">
            <button type="button"  onclick="window.location.href = 'spediliste.php';" class="a-button a-button--primary" >
              <div class="a-button__label"> &nbsp Anwendung starten &nbsp<img src="assets/icons/forward-right-double.svg" height="25" width="25"></div>
            </button>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card m-3 mb-5 border-0">
          <div class="test34" style="background-image: url(bilder/anfahrt.jpg); background-size: cover; height: 160px;">
            <h2 style="color: white;">Fahreranmeldung</h2>
          </div>
          <div class="card-footer">
            <button type="button" onclick="window.location.href = 'fahrerUebersicht.php';" class="a-button a-button--primary" >
              <div class="a-button__label"> &nbsp Anwendung starten &nbsp<img src="assets/icons/forward-right-double.svg" height="25" width="25"></div>
            </button>
          </div>
        </div>
      </div>

      <div class="col">
        <div class="card m-3 mb-5 border-0">
          <div class="test34" style="background-image: url(bilder/tastatur.jpg);  background-size: cover; height: 160px;">
            <h2 style="color: white;">Accountnummer</h2>
          </div>
          <div class="card-footer">
            <button type="button"  onclick="window.location.href = 'accountnummer.php';" id="testbutton" class="a-button a-button--primary" >
              <div class="a-button__label"> &nbsp Anwendung starten &nbsp<img src="assets/icons/forward-right-double.svg" height="25" width="25"></div>
            </button>
          </div>
        </div>
      </div>

      
      <div class="col">
        <div class="card m-3 mb-5 border-0">
          <div class="test34" style="background-image: url(bilder/storage.jpg);  background-size: cover; height: 160px;">
            <h2 style="color: white;">Storage</h2>
          </div>
          <div class="card-footer">
          <a href="http://fe0vmc1220.de.bosch.com:8080/storagefep/login.php" target="_blank" rel="noopener">
            <button type="button"   id="testbutton" class="a-button a-button--primary" >
              <div class="a-button__label"> &nbsp Anwendung starten &nbsp<img src="assets/icons/forward-right-double.svg" height="25" width="25"></div>
            </button></a>
          </div>
        </div>
      </div>

      
      <div class="col">
        <div class="card m-3 mb-5 border-0">
          
          <div class="card-footer">
          
            <button type="button"  id="testbutton" class="a-button a-button--primary" style="width: 100%; margin-top: 5px" >
              <div class="a-button__label" style="margin-left: auto; margin-right: auto;"> &nbsp Docupedia &nbsp<img src="assets/icons/forward-right-double.svg" height="25" width="25"></div>
            </button>
            <br><br />
            <button type="button"  id="testbutton" class="a-button a-button--primary" style="width: 100%;" >
              <div class="a-button__label" style="margin-left: auto; margin-right: auto;"> &nbsp Mitnahme starten &nbsp<img src="assets/icons/forward-right-double.svg" height="25" width="25"></div>
            </button>
            <br><br />
            <button type="button"  id="testbutton" class="a-button a-button--primary" style="width: 100%; margin-bottom: 5px" >
              <div class="a-button__label" style="margin-left: auto; margin-right: auto;"> &nbsp Bosch Zünder &nbsp<img src="assets/icons/forward-right-double.svg" height="25" width="25"></div>
            </button>
    
  </div>
          </div>
        </div>
      </div>

      
    </div>

    
   