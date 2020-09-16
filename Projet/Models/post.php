<?php
require_once dirname(__FILE__).'/../utils/Database.php';
require_once dirname(__FILE__).'/../Models/user.php';
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
    

        public function __construct($_post_id =0,$_dateOfPost='',$_sentNamePost='',$_users_id=0,$_users_id_receive=NULL,$_events_id=NULL,$_contentPost='')
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
			$insertPost = 'INSERT INTO `post`(`post_id`,`sentNamePost`,`users_id`,`users_id_receive`,`events_id`,`contentPost`) VALUES (:post_id, :sentNamePost, :users_id, :users_id_receive, :events_id, :contentPost)';
            $postStatement = $this->db->prepare($insertPost);
            // $postStatement->bindValue(':id_user', $this->id_user,PDO::PARAM_INT);
			$postStatement->bindValue(':post_id', $this->post_id,PDO::PARAM_INT);
            $postStatement->bindValue(':sentNamePost', $this->sentNamePost,PDO::PARAM_STR);
            $postStatement->bindvalue(':users_id',$this->users_id,PDO::PARAM_STR);
            $postStatement->bindvalue(':users_id_receive',$this->users_id_receive,PDO::PARAM_INT);
            $postStatement->bindvalue(':events_id',$this->events_id,PDO::PARAM_INT);
            $postStatement->bindvalue(':contentPost',$this->contentPost,PDO::PARAM_STR);

			return $postStatement->execute();
        }

        public function readAllPost()
		{
            $usersPost_sql = 'SELECT post.post_id, contentPost, post.dateOfPost, post.sentNamePost, post.users_id, post.users_id_receive ,events_id FROM `post` JOIN `users` ON post.users_id = users.users_id WHERE users.users_id =:users.users_id  ORDER BY `dateOfPost` ASC';
            $usersPostStatement = $this->db->prepare($usersPost_sql);
            $usersPost = [];
            if ($usersPostStatement->execute()) {
                if ($usersPostStatement instanceof PDOstatement ) {
                    $usersPost = $usersPostStatement->fetchAll(PDO::FETCH_OBJ);
                }
            }
            return $usersPost;
        }
    }