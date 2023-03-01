<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/mitnahme/database/models/mitnahmedatamodel.php");
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/db_conection.php");
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/helper.php");


class MitnahmedatenService
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
            self::$instance = new MitnahmedatenService();
        }
        return self::$instance;
    }


    public function findMitAll()
    {
        try {
            $queryStr = "SELECT * FROM mitnahme";
            $query = $this->pdo->prepare($queryStr);
            $query->execute();
            
            $result_Acc = $query->fetchAll(PDO::FETCH_ASSOC);
            //print_r($result_Acc); 
            $Acc_array = array();
            foreach ($result_Acc as &$result_Acc) {
                $Acc =  MitData::fromAssoc($result_Acc);
                array_push($Acc_array, $Acc);
            }
            $myArry = json_decode(json_encode($Acc_array), true);

            $fp = fopen($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/mitnahme/mitnahme_verlauf.csv", "w");
          
            $list = array("ID", "Lieferschein", "Transportauftrag", "Ansprechpartner", "Abteilung", "Anfrage", "Mitnahme_Versendet", "Mitnahme_Ausgebucht");
          
           array_unshift($myArry, $list);
          
            foreach ($myArry as $fields) {
                fputcsv($fp, $fields, ';', ' ' );
            }
          
            fclose($fp);



            return $Acc_array;
        } catch (Exception $e) {
            throw $e;
        }
    }

}
