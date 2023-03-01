<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/accountnummer/database/accountdaten_service.php");
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/auth/authguard.php");
AuthGuard::getInstance()->protect(UserType::ADMIN, UserType::SCHICHT, UserType::BUERO, UserType::WERKSTATT, UserType::MONITOR);

$accountdatenService = AccountdatenService::getInstance();
$result = $accountdatenService->findAccAll();


?>


<table id="table" class="table table-light table-sm table-striped table-hover  table-bordered" data-height="750" data-show-columns="true"  data-toggle="table" data-search="true"  data-sortable="true" >

    <thead>
      <tr >
        <th data-sortable="true" >ID</th>
        <th data-sortable="true" >Kundennummer <br>(Warenempfänger)</th>
        <th data-sortable="true">Dienstleister</th>
        <th data-sortable="true" >Account Nr</th>
        <th data-sortable="true">Firma</th>
        <th data-sortable="true">Straße</th>
        <th data-sortable="true" >Stadt (Bundesstaat)</th>
        <th data-sortable="true" >Land</th>
        <th data-sortable="true">Letzte Änderung</th>
        <?php if ($_SESSION['user_role'] != "werkstatt" && $_SESSION['user_role'] != "monitor") {  ?>
        <th data-sortable="true"  id="bearbeiten">Bearbeiten</th>
        <?php } ?>
      </tr>
    </thead>
  <tbody id="tableData">

  
    </tbody>
  </table>
  <script>
    
    var idvalue;
var textstring
 var data =  <?php echo json_encode($result); ?>;
 data.forEach(function(myvalue){
 textstring += "<tr >";
for (var item in myvalue){
  textstring += "<td>" + myvalue[item] + "</td>";
};
<?php if ($_SESSION['user_role'] != "werkstatt" && $_SESSION['user_role'] != "monitor") {  ?>
textstring += "<td><form action='accountnummer/funktion/delete_accountdata.php' id='loeschenForm"+ myvalue.id + "' name='loeschenForm' method='post'><input type='hidden' id='buttonsenden' name='buttonsenden' value=' " + myvalue.id + " '></form><button class='btn btn-link'  onclick='modalEintragbearbeiten(" + myvalue.id +")' style='float: left; padding: 0px 12px 0px 12px;' title='Eintrag bearbeiten'><img src='assets/icons/edit.svg' alt='bearbeiten' width='30' height='30' ></button><button class='btn btn-link' style='float: left; padding: 0px 12px 0px 12px;' onclick='eintragLoeschen(" + myvalue.id +")' title='Eintrag löschen'><img src='assets/icons/eraser-red.svg' alt='Stornieren' width='30' height='30'></button></td></tr>";
<?php }else{ ?>
textstring += "</tr>"
<?php } ?>
}); 
 document.getElementById("tableData").innerHTML = textstring; 
 
</script> 

