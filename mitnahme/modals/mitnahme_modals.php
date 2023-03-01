<!-- Modal Eintarg Anlegen  -->
<div class="modal fade" id="mitnahmeAnlegen" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Neuen Eintrag Anlegen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="accountnummer/funktion/insert_accountdata.php" id="accountForm" name="accountForm" method="post">  
      <div class="modal-body">  

      <input class="form-control" maxlength="10"  type="text" onkeypress="return event.charCode>=48 && event.charCode<=57" name="Lieferschein Nr" id="LieferscheinNr" placeholder="Lieferschein Nr" aria-label="default input example">
     <!-- <span id="fehlermeldungKundennummer" style="color: red"></span> -->
      <br>
      <input class="form-control" list="datalistOptions" id="Transportauftrag" placeholder="Transportauftrag" name="Transportauftrag">
    
      
      <br>
      <input class="form-control" maxlength="10" type="text" name="Ansprechpartner" placeholder="Ansprechpartner" aria-label="default input example">
      <br>

      <input class="form-control" maxlength="30" type="text" name="Abteilung" placeholder="Abteilung" aria-label="default input example">
      <br>

      <input class="form-control" maxlength="30" type="text" name="Anfrage" placeholder="Anfrage" aria-label="default input example">
      <br>
      
      <input class="form-control" list="StadtOptions" id="MitnahmeVersendet" placeholder="Mitnahme Versendet" name="MitnahmeVersendet">
     
     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="background-color: grey;">Abbruch</button>
        <button type="button" onclick="kundennuCheck()" class="btn btn-primary" id="buttonSpeichern"  style="background-color: #007bc0;" >Speichern</button>
      </div>
      </form>
    </div>
  </div>
</div>