<?php

 require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/auth/authguard.php");
 AuthGuard::getInstance()->protect(UserType::ADMIN, UserType::SCHICHT, UserType::BUERO, UserType::WERKSTATT, UserType::MONITOR);




?>

<table id="table" class="table table-light  table-hover table-striped table-bordered"   data-show-columns="true"  data-toggle="table" data-search="true"  data-sortable="true" data-height="680">

    <thead>
      <tr>
        <th data-sortable="true" data-width="100">ID</th>
        <th data-sortable="true">Fahrername</th>
        <th data-sortable="true" data-width="250">Kennzeichen</th>
        <th data-sortable="true">Spedition</th>
        <th data-sortable="true">BOLOG Nr.</th>
        <th data-sortable="true">Sonderfahrt</th>
        <th data-sortable="true" >Ankunftszeit</th>
        <?php if ($_SESSION['user_role'] != "buero" && $_SESSION['user_role'] != "monitor") {  ?>
        <th data-width="50">Abgeschlossen</th>
        <?php } ?>
        <?php if ($_SESSION['user_role'] == "admin" || $_SESSION['user_role'] == "schichtfuehrer" ) {  ?>
        <th data-width="110">Löschen</th>
        <?php } ?>
    
      </tr>
    </thead>
  <tbody id="tableData">

  
    </tbody>
  </table>
  <script>
    var idvalue; 
var textstring;
 var data =  <?php echo json_encode($result); ?>;
 data.forEach(function(myvalue){
 textstring += "<tr><td>" + myvalue.id + "</td>";
 textstring += "<td>" + myvalue.fahrername + "</td>";
 textstring += "<td>" + myvalue.kennzeichen + "</td>";
 textstring += "<td>" + myvalue.spedition + "</td>";
 textstring += "<td>" + myvalue.bolognr + "</td>";
 textstring += "<td>" + myvalue.Sonderfahrt + "</td>";
 textstring += "<td>" + myvalue.ankunftszeit + "</td>";
 <?php if ($_SESSION['user_role'] != "buero" && $_SESSION['user_role'] != "monitor") {  ?>
 textstring += "<td><form action='fahreranmeldung/timerabgeschlossen.php' method='post' id='abgeschlossenForm"+ myvalue.id + "'><input type='hidden' name='checkboxStatus' value='" + myvalue.id + "' ><input onChange='abgeschlossenSend("+ myvalue.id + ")'  style='margin-left: 40%' class='form-check-input big-checkbox' name='checkboxAbgeschlossen' value='" + myvalue.id + "' type='checkbox' id='flexCheckDefault" + myvalue.id + "'" + myvalue.abgeschlossen + "></form></td>";
 <?php } ?>

 <?php if ($_SESSION['user_role'] == "admin" || $_SESSION['user_role'] == "schichtfuehrer") {  ?>
 textstring += "<td><form action='fahreranmeldung/delete_fahrerdaten.php' method='post' id='deleteForm"+ myvalue.id + "'><input type='hidden' name='deleteInput' value='" + myvalue.id + "' > <button type='button' class='btn' onclick='buttonloeschen(" + myvalue.id + ")' style='float: left; padding: 0px 12px 0px 12px; margin-left: 15px;'   title='Eintrag löschen'><img src='assets/icons/eraser-red.svg' alt='Stornieren' width='30' height='30'></button></form> </td></tr>";
 <?php } ?>
}); 
 document.getElementById("tableData").innerHTML = textstring; 
</script> 

