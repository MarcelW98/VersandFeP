<?php

 require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/auth/authguard.php");
 AuthGuard::getInstance()->protect(UserType::ADMIN, UserType::SCHICHT, UserType::BUERO, UserType::WERKSTATT, UserType::MONITOR);




?>

<table id="table" class="table table-light  table-hover table-striped table-bordered"  data-height="680" data-show-columns="true"  data-toggle="table" data-search="true"  data-sortable="true" >

    <thead>
      <tr>
        <th data-sortable="true" data-width="100">ID</th>
        <th data-sortable="true">Fahrername</th>
        <th data-sortable="true" data-width="250">Kennzeichen</th>
        <th data-sortable="true">Spedition</th>
        <th data-sortable="true">BOLOG Nr.</th>
        <th data-sortable="true">Sonderfahrt</th>
        <th data-sortable="true" >Ankunftszeit</th>
        <th data-sortable="true">Abgeschlossen</th>
    
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
 textstring += "<tr><td>" + myvalue.id + "</d>";
 textstring += "<td>" + myvalue.fahrername + "</d>";
 textstring += "<td>" + myvalue.kennzeichen + "</d>";
 textstring += "<td>" + myvalue.spedition + "</d>";
 textstring += "<td>" + myvalue.bolognr + "</d>";
 textstring += "<td>" + myvalue.Sonderfahrt + "</d>";
 textstring += "<td>" + myvalue.ankunftszeit + "</d>";
 textstring += "<td>" + myvalue.abgeschlossen + "</td></tr>";
 }); 
 document.getElementById("tableData").innerHTML = textstring; 
</script> 

