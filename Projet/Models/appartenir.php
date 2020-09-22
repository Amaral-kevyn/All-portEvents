<?php
require_once dirname(__FILE__).'/../utils/Database.php';
require_once dirname(__FILE__).'/../Models/events.php';
require_once dirname(__FILE__).'/../Models/typeOfEvents.php';
require_once dirname(__FILE__).'/../Models/appartenir.php';

    class appartenir
    {
        private $typeOfEvents_id;
        private $activityOfEvents_id;
        private $db;
    

        public function __construct($_typeOfEvents_id =0 ,$_activityOfEvents_id=0)
        {
            
            $this->typeOfEvents_id = $_typeOfEvents_id;
            $this->activityOfEvents_id = $_activityOfEvents_id;
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
        // Création d'une méthode pour insérer une adresse mail valide => Best Practice.
        // public function setMail($mail)
        // {
        //     if(filter_var($mail, FILTER_VALIDATE_EMAIL))
        //     {
        //         $this->mail = $mail;            
        //     }
        // }

        public function getActivity(){
            $sql = 'SELECT typeOfEvents.type,appartenir.typeOfEvents_id,activityOfEvents.activity,appartenir.activityOfEvents_id FROM `appartenir`
            JOIN `activityOfEvents` ON appartenir.activityOfEvents_id = activityOfEvents.activityOfEvents_id
            JOIN `typeOfEvents` ON appartenir.typeOfEvents_id = typeOfEvents.typeOfEvents_id
            WHERE appartenir.typeOfEvents_id = :appartenir.typeOfEvents_id;';
            $statement = $this->db->prepare($sql);
            $statement->bindValue(':typeOfEvents_id',$this->typeOfEvents_id, PDO::PARAM_INT);
            $resultsEvents = array();
            if($statement->execute()){
                $resultsEvents = $statement->fetchAll(PDO::FETCH_ASSOC);
            }
    
            return $resultsEvents;
        }

       
    }