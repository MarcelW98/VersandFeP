<?php

require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/auth/authguard.php");
include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/templates/head.inc.php");
AuthGuard::getInstance()->protect(UserType::ADMIN, UserType::SCHICHT, UserType::BUERO, UserType::WERKSTATT, UserType::MONITOR);

?>
<html>
<style>
  @media (min-width: 1200px) {
    .container {
      max-width: 1700px;
    }
  }

  .btn-secondary {
    background-color: #007bc0;
  }


  .big-checkbox {
    width: 25px;
    height: 25px;
  }
</style>

<body class="bg">
  

  <?php
  include("templates/header.inc.php");

  ?>

  <main>

    <!-- <h2 style="text-align:center;  padding: 10px;">Fahreranmeldungen: <span id="datum"></span></h2> -->
    <br>
    <br>
    <br>
    <div class="container">

      <button type="button" onclick="window.location.href = 'http://fe0vmc1220.de.bosch.com:8080/versandfep/fahrerVerlauf.php';" style="background-color: #007bc0; position: absolute; right:125px;" class="btn btn-primary "  >
        Verlauf
      </button>
      <?php if ($_SESSION['user_role'] != "buero" && $_SESSION['user_role'] != "monitor") {  ?>
    <a href="http://fe0vmc1220.de.bosch.com:8080/versandfep/fahreranmeldung/sprachauswahl2.php" target="_blank" rel="noopener">
      <button type="button" style="background-color: #007bc0; position: absolute; right:250px;" class="btn btn-primary" >
        Anmeldung anlegen
      </button></a>
      <?php } ?>
      <?php
      require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/fahreranmeldung/database/fahrerdaten_service.php");
      $fahrerdatenService = FahrerdatenService::getInstance();
      $result = $fahrerdatenService->findAll();
      include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/fahreranmeldung/fahrerdatentable.php");
      ?>

    </div>

    <!-- Modalt löschen bestätigen -->
    <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Eintrag Bearbeiten</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="modalBody">

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" style="background-color: grey;" data-bs-dismiss="modal">Abbrechen</button>
            <button type="button" onclick="modalDelete()" class="btn btn-primary">Eintrag löschen</button>
          </div>
        </div>
      </div>
    </div>
  </main>

 

  <?php
  include("templates/footer.inc.php");
  include("fahreranmeldung/scripts/fahrerUebersicht_js.php");
  ?>