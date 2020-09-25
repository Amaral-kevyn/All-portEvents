<?php
require_once (dirname(__FILE__).'\..\Utils\Database.php');

class department
{

    public $department_id;
    public $departmentName;
    public $departmentCode;
    private $db;

    public function __construct($_department_id=0 ,$_departmentName='',$_departmentCode='')
    {
        
        $this->department_id = $_department_id;
        $this->departmentName = $_departmentName;
        $this->departmentCode = $_departmentCode;
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

    public function getDepartment(){
        $sql = 'SELECT `departmentName`,`department_id` FROM `department` WHERE `departmentCode` = :departmentCode';
        $statement = $this->db->prepare($sql);
        $statement->bindValue(':departmentCode',$this->departmentCode, PDO::PARAM_INT);
        $results = array();
        if($statement->execute()){
            $results = $statement->fetchAll(PDO::FETCH_ASSOC);
        }

        return $results;
    }
}