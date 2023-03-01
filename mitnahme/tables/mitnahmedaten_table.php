<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/mitnahme/database/mitnahmedaten_service.php");
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/auth/authguard.php");
AuthGuard::getInstance()->protect(UserType::ADMIN, UserType::SCHICHT, UserType::BUERO, UserType::WERKSTATT, UserType::MONITOR);

$mitnahmedatenService = MitnahmedatenService::getInstance();
$result = $mitnahmedatenService->findMitAll();


?>


<table id="table" class="table table-light table-sm table-striped table-hover  table-bordered" data-height="750" data-show-columns="true"  data-toggle="table" data-search="true"  data-sortable="true" >

    <thead>
      <tr >
        <th data-sortable="true" >ID</th>
        <th data-sortable="true" >Lieferschein Nr</th>
        <th data-sortable="true">Transportauftrag</th>
        <th data-sortable="true" >Ansprechpartner</th>
        <th data-sortable="true">Abteilung</th>
        <th data-sortable="true">Anfrage</th>
        <th data-sortable="true" >Mitnahme Versendet</th>
        <th data-sortable="true" >Mitnahme Ausgebucht</th>
        
        <?php 
        // if ($_SESSION['user_role'] != "werkstatt" && $_SESSION['user_role'] != "monitor") {  
          ?>
        <!-- <th data-sortable="true"  id="bearbeiten">Bearbeiten</th> -->
        <?php
      // } 
      ?>
        
      </tr>
    </thead>
  <tbody id="tableData">

  
    </tbody>
  </table>
  <script>
    
  var idvalue;
  var textstring
 var data =  <?php echo json_encode($result); ?>;
 console.log(data);
 data.forEach(function(myvalue){
 textstring += "<tr><td>" + myvalue.id + "</td>";
 textstring += "<td>" + myvalue.lieferschein + "</td>";
 textstring += "<td>" + myvalue.transportauftrag + "</td>";
 textstring += "<td>" + myvalue.ansprechpartner + "</td>";
 textstring += "<td>" + myvalue.abteilung + "</td>";
 textstring += "<td>" + myvalue.datumAnfrage + "</td>";


  if(myvalue.mitnahmeVersendet == null){
    textstring += "<td><input name='checkboxStatus' class='form-check-input big-checkbox' type='checkbox'></td>" 
  }else{
  textstring += "<td>" + myvalue.mitnahmeVersendet + "</td>";
  }

  if(myvalue.mitnahmeAusgebucht == null){
    textstring += "<td><input name='checkboxStatus' class='form-check-input big-checkbox' type='checkbox'></td>" 
  }else{
  textstring += "<td>" + myvalue.mitnahmeAusgebucht + "</td>";
  }

textstring += "</tr>"

}); 

 document.getElementById("tableData").innerHTML = textstring; 
 
</script> 

