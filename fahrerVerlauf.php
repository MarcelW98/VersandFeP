<?php

require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/auth/authguard.php");
include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/templates/head.inc.php");


AuthGuard::getInstance()->protect(UserType::ADMIN, UserType::SCHICHT, UserType::BUERO, UserType::WERKSTATT, UserType::MONITOR);

?>


<style>
  @media (min-width: 1200px) {
    .container {
      max-width: 1700px;
    }
  }

  .btn-secondary {
    background-color: #007bc0;
  }

  #flexCheckDefault {
    width: 20px;
    height: 20px;
  }
</style>

<body class="bg">
  <!-- class="bg"  -->

  <?php
  include("templates/header.inc.php");

  ?>

  <main>
    <br>

    <div class="container">
      <br>
      <br>


      <button type="button" onclick="window.location.href = 'http://fe0vmc1220.de.bosch.com:8080/versandfep/fahrerUebersicht.php';" style="background-color: #007bc0; position: absolute; margin-left: 75%" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Zur täglichen Übersicht
      </button>
      <a href="/versandfep/fahreranmeldung/fahreranmeldung_verlauf.csv" download><button type="button" style="background-color: #007bc0; position: absolute; margin-left: 65%" class="btn btn-primary mb-2">Download Verlauf</button> </a>

      <?php
      require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/fahreranmeldung/database/fahrerdaten_service.php");
      $fahrerdatenService = FahrerdatenService::getInstance();
      $result = $fahrerdatenService->findAllVerlauf();
      include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/fahreranmeldung/verlaufdatentable.php");
      ?>



    </div>


  </main>
  <script>
    window.onload = function() {

      
      let date = new Date();
      
      document.getElementById("pageName").innerHTML = "Verlauf 11.08.2022 - " +  date.toLocaleDateString();
      
   
    
      document.getElementById("table").setAttribute("class", "table table-secondary  table-hover table-striped table-bordered");
    
      
    };
  </script>
  <?php
  include("templates/footer.inc.php");
  ?>