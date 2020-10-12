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
			$insertevent = 'INSERT INTO `participate`(`users_id`,`events_id`) VALUES (:users_id, :events_id)';
            $eventStatement = $this->db->prepare($insertevent);
			$eventStatement->bindValue(':users_id',$this->users_id,PDO::PARAM_INT);
            $eventStatement->bindvalue(':events_id',$this->events_id,PDO::PARAM_INT);
			return $eventStatement->execute();
        }

      /*   public function getEvents(){
            $sql = 'SELECT participate.users_id,users.pseudo,participate.events_id FROM `participate`
            JOIN `users` ON users.users_id = participate.users_id
            JOIN `events` ON events.events_id = participate.events_id
            WHERE participate.events_id = :events_id;';
            $statement = $this->db->prepare($sql);
            $statement->bindValue(':events_id',$this->events_id, PDO::PARAM_INT);
            $resultsEvents = array();
            if($statement->execute()){
                $resultsEvents = $statement->fetchAll(PDO::FETCH_OBJ);
            }
    
            return $resultsEvents;
        } */

         public function getUsersParticipate(){
            $eventList_sql = 'SELECT participate.events_id,participate.users_id,events.time,users.pseudo,events.location,events.budget,events.users_id,events.maxParticipant,activityOfEvents.activity,activityOfEvents.activityOfEvents_id,typeOfEvents.type,typeOfEvents.typeOfEvents_id,villes_france.ville_nom,villes_france.ville_code_postal, events.difficulty, DATE_FORMAT(`dateOfEvents`,"%d/%m/%Y") AS dateOfEvents_format,events.dateOfPublication,events.contentEvent FROM `participate`
            JOIN `events` ON events.events_id = participate.events_id
            JOIN `users` ON users.users_id = participate.users_id
            JOIN `activityOfEvents` ON events.activityOfEvents_id = activityOfEvents.activityOfEvents_id
            JOIN `typeOfEvents` ON events.typeOfEvents_id = typeOfEvents.typeOfEvents_id
            JOIN `villes_france` ON events.villes_france_id = villes_france.villes_france_id
            WHERE participate.users_id = :users_id
             ORDER BY `dateOfEvents` ASC';
            $statementParticipate = $this->db->prepare($eventList_sql);
            $statementParticipate->bindValue(':users_id',$this->users_id, PDO::PARAM_INT);
            $resultsEventsParticipate = array();
            if($statementParticipate->execute()){
                $resultsEventsParticipate = $statementParticipate->fetchAll(PDO::FETCH_OBJ);
            }
    
            return $resultsEventsParticipate;
        } 
       
    }