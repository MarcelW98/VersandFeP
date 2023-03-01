<?php

 class MitData {
    public $id;
    public $lieferschein;
    public $transportauftrag;
    public $ansprechpartner;
    public $abteilung;
    public $datumAnfrage;
    public $mitnahmeVersendet;
    public $mitnahmeAusgebucht;
   


    function __construct($id, $lieferschein, $transportauftrag, $ansprechpartner, $abteilung, $datumAnfrage, $mitnahmeVersendet, $mitnahmeAusgebucht ) {
        $this->id = intval($id);
        $this->lieferschein = $lieferschein;
        $this->transportauftrag = $transportauftrag;
        $this->ansprechpartner = $ansprechpartner;
        $this->abteilung = $abteilung;
        $this->datumAnfrage = $datumAnfrage;
        $this->mitnahmeVersendet = $mitnahmeVersendet;
        $this->mitnahmeAusgebucht = $mitnahmeAusgebucht;
       
      
    }

    public static function fromAssoc(Array $assoc): MitData {
        try {
           return new MitData($assoc["id"], $assoc["lieferschein"], $assoc["transportauftrag"], $assoc["ansprechpartner"], $assoc["abteilung"], $assoc["datumAnfrage"], $assoc["mitnahmeVersendet"],  $assoc["mitnahmeAusgebucht"]);
        } catch (Exception $e) {
           throw new Exception("Acc data failed to build from assoc.");
        }
    }
 }
?>