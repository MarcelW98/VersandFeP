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
</style>

<body class="bg">

  <?php
  include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/templates/header.inc.php");
  ?>

  <main style="margin-top:2%">

    <div class="container">
      <div id="MainView"></div>
    </div>

  </main>

  <?php
  include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/templates/footer.inc.php");
  include($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/scripts/mainview.php");
  ?>