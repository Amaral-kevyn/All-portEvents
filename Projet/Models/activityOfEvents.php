<?php
require_once dirname(__FILE__).'/../utils/Database.php';
require_once dirname(__FILE__).'/../Models/events.php';
require_once dirname(__FILE__).'/../Models/typeOfEvents.php';
require_once dirname(__FILE__).'/../Models/participate.php';

    class activityOfEvents
    {
        private $activityOfEvents_id;
        private $activity;
        private $db;
    

        public function __construct($_activityOfEvents_id =0,$_activity='')
        {
            
            $this->activityOfEvents_id = $_activityOfEvents_id;
            $this->activity = $_activity;
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

        public function createActivityOfEvents()
		{
			$insertPost = 'INSERT INTO `activityOfEvents`(`activityOfEvents_id`,`activity`) VALUES (:activityOfEvents_id, :activity)';
            $postStatement = $this->db->prepare($insertPost);
            // $postStatement->bindValue(':id_user', $this->id_user,PDO::PARAM_INT);
			$postStatement->bindValue(':activityOfEvents_id', $this->activityOfEvents_id,PDO::PARAM_INT);
            $postStatement->bindValue(':activity', $this->activity,PDO::PARAM_STR);

			return $postStatement->execute();
        }

        public function readAllActivityOfEvents()
		{
            $usersPost_sql = 'SELECT activityOfEvents_id, activity FROM `activityOfEvents` WHERE activityOfEvents_id = :activityOfEvents_id ORDER BY `activity` DESC';
            $usersPostStatement = $this->db->prepare($usersPost_sql);
            $usersPostStatement->bindvalue(':activityOfEvents_id',$this->activityOfEvents_id,PDO::PARAM_INT);
            $usersPost = [];
            if ($usersPostStatement->execute()) {
                if ($usersPostStatement instanceof PDOstatement ) {
                    $usersPost = $usersPostStatement->fetchAll(PDO::FETCH_OBJ);
                }
            }
            return $usersPost;
        }

        public function readActivityOfEvents()
		{
			// :nomDeVariable pour les données en attentes
			$sql_viewPost = 'SELECT * FROM `activityOfEvents` WHERE `activityOfEvents_id` = :activityOfEvents_id';
            $postStatement = $this->db->prepare($sql_viewPost );
            $postStatement->bindValue(':activityOfEvents_id', $this->activityOfEvents_id,PDO::PARAM_INT);
			$postView = null;
			if ($postStatement->execute()){
				$postView = $postStatement->fetch(PDO::FETCH_OBJ);
			}
			return $postView;
        }

    

        public function deleteActivityOfEvents()
        {
            $sqlDelete = 'DELETE FROM `activityOfEvents` WHERE activityOfEvents_id = :activityOfEvents_id';
            $postDelete = $this->db->prepare($sqlDelete);
            $postDelete->bindValue(':activityOfEvents_id',$this->activityOfEvents_id,PDO::PARAM_INT);
            return $postDelete->execute();
        }
    }