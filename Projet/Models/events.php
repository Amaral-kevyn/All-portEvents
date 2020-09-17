<?php
require_once dirname(__FILE__).'/../utils/Database.php';
require_once dirname(__FILE__).'/../Models/user.php';
require_once dirname(__FILE__).'/../Models/post.php';
require_once dirname(__FILE__).'/../Models/participate.php';
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
        private $db;
    

        public function __construct($_events_id =0,$_location='',$_budget='',$_maxParticipant='',$_difficulty='',$_dateOfEvents='',$_dateOfPublication='',$_typeOfEvents_id='',$_users_id='')
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

        public function create()
		{
			$insertEvents = 'INSERT INTO `users`(`location`,`budget`,`maxParticipant`,`difficulty`,`dateOfEvents`,`dateOfPublication`,`typeOfEvents_id`,`users_id`) VALUES (:location, :budget, :maxParticipant, :difficulty, :dateOfEvents, :dateOfPublication, :typeOfEvents_id, :users_id)';
            $eventStatement = $this->db->prepare($insertEvents);
            // $usersStatement->bindValue(':id_user', $this->id_user,PDO::PARAM_INT);
			$eventStatement->bindValue(':location', $this->location,PDO::PARAM_STR);
            $eventStatement->bindValue(':budget', $this->budget,PDO::PARAM_STR);
            $eventStatement->bindvalue(':maxParticipant',$this->maxParticipant,PDO::PARAM_STR);
            $eventStatement->bindvalue(':difficulty',$this->difficulty,PDO::PARAM_STR);
            $eventStatement->bindvalue(':dateOfEvents',$this->dateOfEvents,PDO::PARAM_STR);
            $eventStatement->bindvalue(':dateOfPublication',$this->dateOfPublication,PDO::PARAM_STR);
            $eventStatement->bindvalue(':typeOfEvents_id',$this->typeOfEvents_id,PDO::PARAM_STR);
            $eventStatement->bindvalue(':users_id',$this->users_id,PDO::PARAM_INT);

			return $eventStatement->execute();
        }

        public function readSingle()
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
        
        public function readAll()
		{
            // $offset = ($currentPage - 1) * $patientPerPage;
            $eventList_sql = 'SELECT `events_id`,`admin_id`,`typeOfEvents_id`,`location`,`users_id`,`civility`, `budget`, `dateOfEvents` FROM `events` ORDER BY `dateOfPublication` ASC';
            $eventStatement = $this->db->prepare($eventList_sql);
            $eventList = [];
            if ($eventStatement->execute()) {
                if ($eventStatement instanceof PDOstatement ) {
                    $eventList = $eventStatement->fetchAll(PDO::FETCH_OBJ);
                }
            }
            return $eventList;
        }
        public function update()
        {
            $sqlUpdateEvent = 'UPDATE events SET location=:location,budget=:budget,typeOfEvents_id=:typeOfEvents_id,maxParticipant=:maxParticipant,difficulty=:difficulty,dateOfEvents=:dateOfEvents,users_id=:users_id WHERE events_id=:events_id';
            $usersStatement = $this->db->prepare($sqlUpdateEvent;
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
        public function delete()
        {
            $sqlDeleteEvent = 'DELETE FROM `events` WHERE `events_id`=:events_id';
            $eventDelete = $this->db->prepare($sqlDeleteEvent);
            $eventDelete->bindValue(':events_id', $this->events_id,PDO::PARAM_INT);
            return $eventDelete->execute();
        }

    }
        ?>