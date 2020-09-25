<?php
require_once dirname(__FILE__).'/../Utils/Database.php';
require_once dirname(__FILE__).'/../Models/User.php';
    class post
    {
        private $post_id;
        private $dateOfPost;
        private $sentNamePost;
        private $users_id;
        private $users_id_receive;
        private $events_id;
        private $contentPost;
        private $db;
    

        public function __construct($_post_id =0,$_dateOfPost='',$_sentNamePost='',$_users_id=0,$_users_id_receive=0,$_events_id=0,$_contentPost='')
        {
            
            $this->post_id = $_post_id;
            $this->dateOfPost = $_dateOfPost;
            $this->sentNamePost = $_sentNamePost;
            $this->users_id = $_users_id;
            $this->users_id_receive = $_users_id_receive;
            $this->events_id = $_events_id;
            $this->contentPost = $_contentPost;
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

        public function createPost()
		{
			$insertPost = 'INSERT INTO `post`(`post_id`,`sentNamePost`,`users_id`,`users_id_receive`,`contentPost`) VALUES (:post_id, :sentNamePost, :users_id, :users_id_receive, :contentPost)';
            $postStatement = $this->db->prepare($insertPost);
            // $postStatement->bindValue(':id_user', $this->id_user,PDO::PARAM_INT);
			$postStatement->bindValue(':post_id', $this->post_id,PDO::PARAM_INT);
            $postStatement->bindValue(':sentNamePost', $this->sentNamePost,PDO::PARAM_STR);
            $postStatement->bindvalue(':users_id',$this->users_id,PDO::PARAM_INT);
            $postStatement->bindvalue(':users_id_receive',$this->users_id_receive,PDO::PARAM_INT);
           /*  $postStatement->bindvalue(':events_id',$this->events_id,PDO::PARAM_INT); */
            $postStatement->bindvalue(':contentPost',$this->contentPost,PDO::PARAM_STR);

			return $postStatement->execute();
        }

        public function readAllPost()
		{
            $usersPost_sql = 'SELECT post_id, contentPost, dateOfPost, sentNamePost, users_id, users_id_receive FROM `post` WHERE users_id = :users_id ORDER BY `dateOfPost` DESC';
            $usersPostStatement = $this->db->prepare($usersPost_sql);
            $usersPostStatement->bindvalue(':users_id',$this->users_id,PDO::PARAM_INT);
            $usersPost = [];
            if ($usersPostStatement->execute()) {
                if ($usersPostStatement instanceof PDOstatement ) {
                    $usersPost = $usersPostStatement->fetchAll(PDO::FETCH_OBJ);
                }
            }
            return $usersPost;
        }

        public function readAllPostModerateur()
		{
            $usersPostModerateur_sql = 'SELECT post_id, contentPost, dateOfPost, sentNamePost, users_id, users_id_receive FROM `post` ORDER BY `dateOfPost` DESC';
            $usersPostStatementModerateur = $this->db->prepare($usersPostModerateur_sql);
            $usersPostModerateur = [];
            if ($usersPostStatementModerateur->execute()) {
                if ($usersPostStatementModerateur instanceof PDOstatement ) {
                    $usersPostModerateur = $usersPostStatementModerateur->fetchAll(PDO::FETCH_OBJ);
                }
            }
            return $usersPostModerateur;
        }

        public function readPost()
		{
			// :nomDeVariable pour les données en attentes
			$sql_viewPost = 'SELECT * FROM `post` WHERE `post_id` = :post_id';
            $postStatement = $this->db->prepare($sql_viewPost );
            $postStatement->bindValue(':post_id', $this->post_id,PDO::PARAM_INT);
			$postView = null;
			if ($postStatement->execute()){
				$postView = $postStatement->fetch(PDO::FETCH_OBJ);
			}
			return $postView;
        }

        public function deletePost()
        {
            $sqlDelete = 'DELETE FROM `post` WHERE post_id = :post_id';
            $postDelete = $this->db->prepare($sqlDelete);
            $postDelete->bindValue(':post_id',$this->post_id,PDO::PARAM_INT);
            return $postDelete->execute();
        }
    }