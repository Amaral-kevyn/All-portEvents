<?php
require_once dirname(__FILE__).'/../utils/Database.php';
require_once dirname(__FILE__).'/../Models/events.php';
require_once dirname(__FILE__).'/../Models/activityOfEvents.php';
    class post
    {
        private $typeOfEvents_id;
        private $type;
        private $activityOfEvents_id;
        private $db;
    

        public function __construct($_typeOfEvents_id =0,$_type='',$_activityOfEvents_id='')
        {
            
            $this->typeOfEvents_id = $_typeOfEvents_id;
            $this->type = $_type;
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

        public function createTypeOfEvents()
		{
			$insertTypeOfEvents = 'INSERT INTO `typeOfEvents`(`typeOfEvents_id`,`type`,`activityOfEvents_id`) VALUES (:typeOfEvents_id, :type, :activityOfEvents_id,)';
            $TypeOfEventsStatement = $this->db->prepare($insertTypeOfEvents);
            // $TypeOfEventsStatement->bindValue(':id_user', $this->id_user,PDO::PARAM_INT);
			$TypeOfEventsStatement->bindValue(':typeOfEvents_id', $this->typeOfEvents_id,PDO::PARAM_INT);
            $TypeOfEventsStatement->bindValue(':activityOfEvents_id', $this->activityOfEvents_id,PDO::PARAM_STR);
            $TypeOfEventsStatement->bindvalue(':type',$this->type,PDO::PARAM_INT);
			return $TypeOfEventsStatement->execute();
        }

        public function readAllTypeOfEvents()
		{
            $TypeOfEvents_sql = 'SELECT typeOfEvents_id, type, activityOfEvents_id FROM `typeOfEvents` WHERE typeOfEvents_id = :typeOfEvents_id ORDER BY `type` DESC';
            $TypeOfEventsStatement = $this->db->prepare($TypeOfEvents_sql);
            $TypeOfEventsStatement->bindvalue(':typeOfEvents_id',$this->typeOfEvents_id,PDO::PARAM_INT);
            $TypeOfEvents = [];
            if ($TypeOfEventsStatement->execute()) {
                if ($TypeOfEventsStatement instanceof PDOstatement ) {
                    $TypeOfEvents = $TypeOfEventsStatement->fetchAll(PDO::FETCH_OBJ);
                }
            }
            return $TypeOfEvents;
        }

        public function readTypeOfEvents()
		{
			// :nomDeVariable pour les données en attentes
			$sql_viewTypeOfEvents = 'SELECT * FROM `typeOfEvents` WHERE `typeOfEvents_id` = :typeOfEvents_id';
            $TypeOfEventsStatement = $this->db->prepare($sql_viewTypeOfEvents );
            $TypeOfEventsStatement->bindValue(':typeOfEvents_id', $this->typeOfEvents_id,PDO::PARAM_INT);
			$TypeOfEventsView = null;
			if ($TypeOfEventsStatement->execute()){
				$TypeOfEventsView = $TypeOfEventsStatement->fetch(PDO::FETCH_OBJ);
			}
			return $TypeOfEventsView;
        }

        public function deleteTypeOfEvents()
        {
            $sqlDeleteTypeOfEvents = 'DELETE FROM `TypeOfEvents` WHERE TypeOfEvents_id = :TypeOfEvents_id';
            $postDeleteTypeOfEvents = $this->db->prepare($sqlDeleteTypeOfEvents);
            $postDeleteTypeOfEvents->bindValue(':TypeOfEvents_id',$this->TypeOfEvents_id,PDO::PARAM_INT);
            return $postDeleteTypeOfEvents->execute();
        }

    }