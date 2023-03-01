<?php
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/accountnummer/database/models/accountdatamodel.php");
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/db_conection.php");
require_once($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/database/helper.php");


class AccountdatenService
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
            self::$instance = new AccountdatenService();
        }
        return self::$instance;
    }


    public function findAccAll()
    {
        try {
            $queryStr = "SELECT * FROM accountnummerdaten";
            $query = $this->pdo->prepare($queryStr);
            $query->execute();
            $result_Acc = $query->fetchAll(PDO::FETCH_ASSOC);
            $Acc_array = array();
            foreach ($result_Acc as &$result_Acc) {
                $Acc =  AccData::fromAssoc($result_Acc);
                array_push($Acc_array, $Acc);
            }
            $myArry = json_decode(json_encode($Acc_array), true);

            $fp = fopen($_SERVER['DOCUMENT_ROOT'] .  "/versandfep" . "/accountnummer/Accountnummernliste.csv", "w");
          
           $list = array("ID", "Kundennummer", "Dienstleitser", "Account Nr", "Firma", "Straße", "Stadt", "Land", "letzte Änderung");
          
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
