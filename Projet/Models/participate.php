<?php
require_once dirname(__FILE__).'/../utils/Database.php';
require_once dirname(__FILE__).'/../Models/events.php';
require_once dirname(__FILE__).'/../Models/User.php';
require_once dirname(__FILE__).'/../Models/typeOfEvents.php';
require_once dirname(__FILE__).'/../Models/activityOfEvents.php';

    class participate
    {
        private $users_id;
        private $events_id;
        private $db;
    

        public function __construct($_users_id =0 ,$_events_id=0)
        {
            
            $this->users_id = $_users_id;
            $this->events_id = $_events_id;
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

        public function createListEvents()
		{
			$insertevent = 'INSERT INTO `participate`(`users_id`,`event_id`) VALUES (:users_id, :event_id)';
            $eventStatement = $this->db->prepare($insertevent);
            // $users_idStatement->bindValue(':id_user', $this->id_user,PDO::PARAM_INT);
			$eventStatement->bindValue(':users_id', $this->users_id,PDO::PARAM_INT);
            $eventStatement->bindvalue(':event_id',$this->event_id,PDO::PARAM_INT);
			return $eventStatement->execute();
        }

        public function getEvents(){
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