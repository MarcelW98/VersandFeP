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

  td {
    font-size: 16px;
  }

  th {
    font-size: 18px;
  }
  
</style>

<body class="bg">
  <?php
  include("templates/header.inc.php");
  ?>

  <main>
    <br>
    <div class="container">
    <?php if ($_SESSION['user_role'] != "monitor") {  ?>
      <button type="button" style="background-color: #007bc0; position: absolute; margin-top: 10px; right:140px;" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
        Eintrag Anlegen 
      </button>
      <?php } ?>
      <a href="/versandfep/accountnummer/Accountnummernliste.csv" download><button type="button" style="background-color: #007bc0; position: absolute; right:325px; margin-top: 10px;" class="btn btn-primary mb-2">Download Tabelle</button> </a>
      <?php
      include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/accountnummer/modals/accountnummer_modals.php");
      ?>

      <div class="table-responsive ">
        <div id="Accountdatentabelle">
          <?php
          include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/accountnummer/tables/accoundaten_table.php");
          ?>
        </div>
      </div>
    </div>
  </main>

  <?php
  include("templates/footer.inc.php");
  
  include("accountnummer/scripts/accountnummer_js.php");
  ?>
