<?php
require_once dirname(__FILE__).'/../utils/Database.php';
    class users
    {
        private $users_id;
        private $lastname;
        private $firstname;
        private $birthdate;
        private $email;
        private $pseudo;
        private $password;
        private $zipCode;
        private $civility;
        private $cle;
        private $actif;
        private $admin_id;
        private $db;
    

        public function __construct($_users_id =0,$_lastname='',$_firstname='',$_birthdate='',$_email='',$_pseudo='',$_password='',$_zipCode='',$_civility='',$_cle=0,$_actif=0,$admin=0)
        {
            
            $this->users_id = $_users_id;
            $this->lastname = $_lastname;
            $this->firstname = $_firstname;
            $this->birthdate = $_birthdate;
            $this->email = $_email;
            $this->pseudo = $_pseudo;
            $this->password = $_password;
            $this->zipCode = $_zipCode;
            $this->civility = $_civility;
            $this->cle = $_cle;
            $this->actif = $_actif;
            $this->roles_id = $_roles_id;
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

        public function create()
		{
			$insertUser = 'INSERT INTO `users`(`lastname`, `firstname`,`birthdate`,`email`,`pseudo`, `password`, `photo`,`zipCode`,`civility`,`cle`,`actif`, `admin_id`) VALUES (:lastname, :firstname, :birthdate, :email,:pseudo, :password, :photo, :zipCode, :civility, :cle, :actif, :admin_id )';
            $usersStatement = $this->db->prepare($insertUser);
            // $usersStatement->bindValue(':id_user', $this->id_user,PDO::PARAM_INT);
			$usersStatement->bindValue(':lastname', $this->lastname,PDO::PARAM_STR);
            $usersStatement->bindValue(':firstname', $this->firstname,PDO::PARAM_STR);
            $usersStatement->bindvalue(':birthdate',$this->birthdate,PDO::PARAM_STR);
            $usersStatement->bindvalue(':email',$this->email,PDO::PARAM_STR);
            $usersStatement->bindvalue(':pseudo',$this->pseudo,PDO::PARAM_STR);
            $usersStatement->bindvalue(':photo',$this->photo,PDO::PARAM_STR);
            $usersStatement->bindvalue(':zipCode',$this->zipCode,PDO::PARAM_INT);
            $usersStatement->bindvalue(':civility',$this->civility,PDO::PARAM_INT);
            $usersStatement->bindvalue(':cle',$this->cle,PDO::PARAM_INT);
            $usersStatement->bindvalue(':actif',$this->actif,PDO::PARAM_INT);
            $usersStatement->bindvalue(':admin_id',$this->admin_id,PDO::PARAM_INT);

			return $usersStatement->execute();
        }

        public function readSingle()
		{
			// :nomDeVariable pour les données en attentes
			$sql_viewUsers = 'SELECT `users_id`, `lastname`, `firstname`,DATE_FORMAT(`birthdate`,"%d/%m/%Y") AS birthdate_format,`birthdate`,`email`,`pseudo`,`civility`,`admin_id` FROM `users` WHERE `users_id` = :users_id';
            $usersStatement = $this->db->prepare($sql_viewUsers);
            $usersStatement->bindValue(':users_id', $this->users_id,PDO::PARAM_INT);
			$usersView = null;
			if ($usersStatement->execute()){
				$usersView = $usersStatement->fetch(PDO::FETCH_OBJ);
			}
			return $usersView;
        }
        public function readPregMatchMail()
        {
            $users_sql = 'SELECT `email` FROM `users` WHERE `email`=:email';
            $userStatment = $this->db->prepare($users_sql);
            $userStatment->bindValue(':email', $this->email, PDO::PARAM_STR);
            $users = null;
            if ($userStatment->execute()) {
                $users = $userStatment->fetchAll(PDO::FETCH_OBJ);
            }
            return $users;
        }
        public function connect(){
          $users_connect = 'SELECT * FROM `users` WHERE `email`=:email';
          $usersStatement = $this->db->prepare($users_connect);
          $usersStatement->bindValue(':email', $this->email,PDO::PARAM_STR);
          $userCo = null;
          if ($usersStatement->execute()){
              $userCo = $usersStatement->fetch(PDO::FETCH_OBJ);
          }
          return $userCo;
        }
        
        public function readAll()
		{
            // $offset = ($currentPage - 1) * $patientPerPage;
            $usersList_sql = 'SELECT `users_id`,`lastname`, `firstname`,TIMESTAMPDIFF(year,birthdate,CURRENT_DATE) AS age, `pseudo` FROM `users` ORDER BY `lastname` ASC';
            $usersStatement = $this->db->prepare($usersList_sql);
            $usersList = [];
            if ($usersStatement->execute()) {
                if ($usersStatement instanceof PDOstatement ) {
                    $usersList = $usersStatement->fetchAll(PDO::FETCH_OBJ);
                }
            }
            return $usersList;
        }
        public function update()
        {
            $sqlUpdate = 'UPDATE users SET lastname=:lastname,firstname=:firstname,birthdate=:birthdate,email=:email,pseudo=:pseudo WHERE users_id=:users_id';
            $usersStatement = $this->db->prepare($sqlUpdate );
            $usersStatement->bindValue(':users_id', $this->users_id,PDO::PARAM_INT);
            $usersStatement->bindValue(':lastname', $this->lastname,PDO::PARAM_STR);
            $usersStatement->bindValue(':firstname', $this->firstname,PDO::PARAM_STR);
            $usersStatement->bindValue(':pseudo', $this->pseudo,PDO::PARAM_STR);
            $usersStatement->bindvalue(':birthdate',$this->birthdate,PDO::PARAM_STR);
            $usersStatement->bindvalue(':email',$this->email,PDO::PARAM_STR);
            $usersStatement->bindvalue(':pseudo',$this->pseudo,PDO::PARAM_STR);

            return $usersStatement->execute();
        }
        public function delete()
        {
            $sqlDelete = 'DELETE FROM `users` WHERE `users_id`=:users_id';
            $usersDelete = $this->db->prepare($sqlDelete );
            $usersDelete->bindValue(':users_id', $this->users_id,PDO::PARAM_INT);
            return $usersDelete->execute();
        }

    }
        ?>