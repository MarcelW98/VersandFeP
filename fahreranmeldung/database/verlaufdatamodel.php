<?php

 class VerlaufData {
    public $id;
    public $fahrername;
    public $kennzeichen;
    public $spedition;
    public $bolognr;
    public $Sonderfahrt;
    public $ankunftszeit;
    public $abgeschlossen;


    function __construct($id, $fahrername, $kennzeichen, $spedition, $bolognr, $Sonderfahrt, $ankunftszeit, $abgeschlossen ) {
        $this->id = intval($id);
        $this->fahrername = $fahrername;
        $this->kennzeichen = $kennzeichen;
        $this->spedition = $spedition;
        $this->bolognr = $bolognr;
        $this->Sonderfahrt = $Sonderfahrt;
        $this->ankunftszeit  = $ankunftszeit ;
        $this->abgeschlossen = $abgeschlossen;
    }

    public static function fromAssoc(Array $assoc): VerlaufData {
        try {
           return new VerlaufData($assoc["id"], $assoc["fahrername"], $assoc["kennzeichen"], $assoc["spedition"], $assoc["bolognr"],  $assoc["Sonderfahrt"],  $assoc["ankunftszeit"], $assoc["abgeschlossen"]);
        } catch (Exception $e) {
           throw new Exception("Acc data failed to build from assoc.");
        }
    }
 }
?>