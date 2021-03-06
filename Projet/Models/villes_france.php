<?php
require_once (dirname(__FILE__).'\..\Utils\Database.php');

class villes_france
{

    public $villes_france_id;
    public $ville_nom;
    public $ville_code_postal;
    private $db;

    public function __construct($_villes_france_id=0 ,$_ville_nom='',$_ville_code_postal='')
    {
        
        $this->villes_france_id = $_villes_france_id;
        $this->ville_nom = $_ville_nom;
        $this->ville_code_postal = $_ville_code_postal;
        $this->db = Databases::getInstance();
    }
     // Création d'une méthode magique getter qui permettra de créer dynamiquement un getter pour chaque attribut existant.
    // Méthode permettant de faire des échos de propriétés privées.
    public function __get($attr)
    {
        return $this->$attr;
    }

    public function __set($attr, $value)
    {
        $this->$attr = $value;
    }

    public function getVilles(){
        $sql = 'SELECT `ville_nom`,`villes_france_id` FROM `villes_france` WHERE `ville_code_postal` = :ville_code_postal';
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':ville_code_postal',$this->ville_code_postal, PDO::PARAM_INT);
        $results = array();
        if($statement->execute()){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return $results;
    }
}