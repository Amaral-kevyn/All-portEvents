<?php
require_once dirname(__FILE__).'/../Utils/Database.php';
require_once dirname(__FILE__).'/../Models/User.php';
require_once dirname(__FILE__).'/../Models/post.php';
require_once dirname(__FILE__).'/../Models/participate.php';
require_once dirname(__FILE__).'/../Models/villes_france.php';
    class events
    {
        private $events_id;
        private $location;
        private $budget;
        private $maxParticipant;
        private $difficulty;
        private $dateOfEvents;
        private $dateOfPublication;
        private $typeOfEvents_id;
        private $users_id;
        private $activityOfEvents_id;
        private $villes_france_id;
        private $contentEvent;
        private $time;
        private $db;
    

        public function __construct($_events_id =0,$_location='',$_budget=0,$_maxParticipant=0,$_difficulty=0,$_dateOfEvents='',$_dateOfPublication='',$_typeOfEvents_id=0,$_users_id=0,$_activityOfEvents_id=0,$_villes_france_id=0,$_contentEvent='',$_time='')
        {
            
            $this->events_id = $_events_id;
            $this->location = $_location;
            $this->budget = $_budget;
            $this->maxParticipant = $_maxParticipant;
            $this->difficulty = $_difficulty;
            $this->dateOfEvents = $_dateOfEvents;
            $this->dateOfPublication = $_dateOfPublication;
            $this->typeOfEvents_id = $_typeOfEvents_id;
            $this->users_id = $_users_id;
            $this->activityOfEvents_id = $_activityOfEvents_id;
            $this->villes_france_id = $_villes_france_id;
            $this->contentEvent = $_contentEvent;
            $this->time = $_time;
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
        //     if(filter_var($mail, FILTER_VALIDATE_difficulty))
        //     {
        //         $this->mail = $mail;            
        //     }
        // }

        public function createEvents()
		{
			$insertEvents = 'INSERT INTO `events`(`events_id`,`location`,`budget`,`maxParticipant`,`difficulty`,`dateOfEvents`,`typeOfEvents_id`,`users_id`,`activityOfEvents_id`,`villes_france_id`,`contentEvent`,`time`) VALUES (:events_id, :location, :budget, :maxParticipant, :difficulty, :dateOfEvents, :typeOfEvents_id, :users_id, :activityOfEvents_id, :villes_france_id, :contentEvent, :time)';
            $eventStatement = $this->db->prepare($insertEvents);
            $eventStatement->bindValue(':events_id', $this->events_id,PDO::PARAM_INT);
			$eventStatement->bindValue(':location', $this->location,PDO::PARAM_STR);
            $eventStatement->bindValue(':budget', $this->budget,PDO::PARAM_INT);
            $eventStatement->bindvalue(':maxParticipant',$this->maxParticipant,PDO::PARAM_INT);
            $eventStatement->bindvalue(':difficulty',$this->difficulty,PDO::PARAM_INT);
            $eventStatement->bindvalue(':dateOfEvents',$this->dateOfEvents,PDO::PARAM_STR);
            $eventStatement->bindvalue(':typeOfEvents_id',$this->typeOfEvents_id,PDO::PARAM_INT);
            $eventStatement->bindvalue(':users_id',$this->users_id,PDO::PARAM_INT);
            $eventStatement->bindvalue(':activityOfEvents_id',$this->activityOfEvents_id,PDO::PARAM_INT);
            $eventStatement->bindvalue(':villes_france_id',$this->villes_france_id,PDO::PARAM_INT);
            $eventStatement->bindvalue(':contentEvent',$this->contentEvent,PDO::PARAM_STR);
            $eventStatement->bindvalue(':time',$this->time,PDO::PARAM_STR);

			return $eventStatement->execute();
        }

         public function readSingleEvents()
		{
			// :nomDeVariable pour les données en attentes
			$sql_viewEvent = 'SELECT `events_id`,`typeOfEvents_id`,`location`, `budget`,`maxParticipant`,`difficulty`,`dateOfEvents`,`users_id` FROM `events` WHERE `events_id` = :events_id';
            $eventStatement = $this->db->prepare($sql_viewEvent);
            $eventStatement->bindValue(':events_id', $this->events_id,PDO::PARAM_INT);
			$eventView = null;
			if ($eventStatement->execute()){
				$eventView = $eventStatement->fetch(PDO::FETCH_OBJ);
			}
			return $eventView;
        }
        
        public function readAllEvents()
		{
            // $offset = ($currentPage - 1) * $patientPerPage;
            $eventList_sql = 'SELECT events.events_id,events.time,users.pseudo,events.location,events.budget,events.users_id,events.maxParticipant,activityOfEvents.activity,activityOfEvents.activityOfEvents_id,typeOfEvents.type,typeOfEvents.typeOfEvents_id,villes_france.ville_nom,villes_france.ville_code_postal, events.difficulty, DATE_FORMAT(`dateOfEvents`,"%d/%m/%Y") AS dateOfEvents_format,events.dateOfPublication,events.contentEvent FROM `events`
            JOIN `activityOfEvents` ON events.activityOfEvents_id = activityOfEvents.activityOfEvents_id
            JOIN `typeOfEvents` ON events.typeOfEvents_id = typeOfEvents.typeOfEvents_id
            JOIN `villes_france` ON events.villes_france_id = villes_france.villes_france_id
            JOIN `users` ON events.users_id = users.users_id
             ORDER BY `dateOfPublication` ASC';
            $eventStatement = $this->db->prepare($eventList_sql);
            $eventList = [];
            if ($eventStatement->execute()) {
                if ($eventStatement instanceof PDOstatement ) {
                    $eventList = $eventStatement->fetchAll(PDO::FETCH_OBJ);
                }
            }
            return $eventList;
        }

       /*  public function updateEvents()
        {
            $sqlUpdateEvent = 'UPDATE events SET location=:location,budget=:budget,typeOfEvents_id=:typeOfEvents_id,maxParticipant=:maxParticipant,difficulty=:difficulty,dateOfEvents=:dateOfEvents,users_id=:users_id WHERE events_id=:events_id';
            $usersStatement = $this->db->prepare($sqlUpdateEvent);
            $eventStatement->bindValue(':events_id', $this->events_id,PDO::PARAM_INT);
            $eventStatement->bindValue(':location', $this->location,PDO::PARAM_STR);
            $eventStatement->bindValue(':budget', $this->budget,PDO::PARAM_STR);
            $eventStatement->bindValue(':dateOfEvents', $this->dateOfEvents,PDO::PARAM_STR);
            $eventStatement->bindvalue(':maxParticipant',$this->maxParticipant,PDO::PARAM_STR);
            $eventStatement->bindvalue(':difficulty',$this->difficulty,PDO::PARAM_STR);
            $eventStatement->bindvalue(':dateOfEvents',$this->dateOfEvents,PDO::PARAM_STR);
            $eventStatement->bindvalue(':users_id',$this->users_id,PDO::PARAM_INT);

            return $eventStatement->execute();
        }

        public function deleteEvents()
        {
            $sqlDeleteEvent = 'DELETE FROM `events` WHERE `events_id`=:events_id';
            $eventDelete = $this->db->prepare($sqlDeleteEvent);
            $eventDelete->bindValue(':events_id', $this->events_id,PDO::PARAM_INT);
            return $eventDelete->execute();
        } */
    }