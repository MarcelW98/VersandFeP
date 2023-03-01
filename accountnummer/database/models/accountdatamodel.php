<?php

 class AccData {
    public $id;
    public $kundennummer;
    public $dienstleister;
    public $acc_nummer;
    public $firma;
    public $straße;
    public $stadt;
    public $land;
    public $timestamp;


    function __construct($id, $kundennummer, $dienstleister, $acc_nummer, $firma, $straße, $stadt, $land, $timestamp ) {
        $this->id = intval($id);
        $this->kundennummer = $kundennummer;
        $this->dienstleister = $dienstleister;
        $this->acc_nummer = $acc_nummer;
        $this->firma = $firma;
        $this->straße = $straße;
        $this->stadt = $stadt;
        $this->land = $land;
        $this->timestamp  = $timestamp ;
    }

    public static function fromAssoc(Array $assoc): AccData {
        try {
           return new AccData($assoc["id"], $assoc["kundennummer"], $assoc["dienstleister"], $assoc["acc_nummer"], $assoc["firma"], $assoc["straße"], $assoc["stadt"], $assoc["land"], $assoc["timestamp"]);
        } catch (Exception $e) {
           throw new Exception("Acc data failed to build from assoc.");
        }
    }
 }
?>