<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/fahreranmeldung/database/fahrerdatamodel.php");
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/fahreranmeldung/database/verlaufdatamodel.php");
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/db_conection.php");
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/helper.php");


class FahrerdatenService
{
    protected $pdo;
    protected static $instance;

    protected function __construct()
    {
        $this->pdo = DB::getInstance();
    }

    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new FahrerdatenService();
        }
        return self::$instance;
    }

  


    public function findAll()
    {
        try {
            $queryStr = "SELECT * FROM fahrerdaten";
            $query = $this->pdo->prepare($queryStr);
            $query->execute();
            $result_Fah = $query->fetchAll(PDO::FETCH_ASSOC);
             $Fah_array = array();
             foreach ($result_Fah as &$result_Fah) {
                 $Fah =  FahrerData::fromAssoc($result_Fah);
                 array_push($Fah_array, $Fah);
             }
            
            return  $Fah_array;
        } catch (Exception $e) {
            throw $e;
        }
    }

    public function findAllVerlauf()
    {
        try {
            $queryStr = "SELECT * FROM fahrerdatenverlauf";
            $query = $this->pdo->prepare($queryStr);
            $query->execute();
            $result_Fah = $query->fetchAll(PDO::FETCH_ASSOC);
             $Fah_array = array();

           
              foreach ($result_Fah as &$result_Fah) {
                  $Fah =  VerlaufData::fromAssoc($result_Fah);
              array_push($Fah_array, $Fah);
             }
             $myArry = json_decode(json_encode($Fah_array), true);

             $fp = fopen($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/fahreranmeldung/fahreranmeldung_verlauf.csv", "w");
           
            $list = array("ID", "Fahrername", "Kennzeichen", "Spedition", "BOLOG NR.", "Sonderfahrt", "Ankunftszeit", "Abgeschlossen");
           
           array_unshift($myArry, $list);
           
            foreach ($myArry as $fields) {
                fputcsv($fp, $fields, ';', ' ' );
            }
           
            fclose($fp);
            return $Fah_array;
        } catch (Exception $e) {
            throw $e;
        }
    }


}
