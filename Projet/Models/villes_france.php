<?php
require_once (dirname(__FILE__).'\..\Utils\Database.php');

class villes_france
{

    public $villes_france_id;
    public $ville_nom;
    public $ville_code_postal;
    private $db;

    public function __construct(){
        $this->db = Database::getInstance();
    }

    public function getVilles(){
        $sql = 'SELECT `ville_nom` FROM `villes_france_free` WHERE `ville_code_postal` = :ville_code_postal';
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':ville_code_postal',$this->ville_code_postal, PDO::PARAM_INT);
        $results = array();
        if($statement->execute()){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return $results;
    }
}