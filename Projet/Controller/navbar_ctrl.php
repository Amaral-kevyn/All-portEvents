<?php
require_once dirname(__FILE__) . '/../Models/user.php';
require_once dirname(__FILE__) . '/../Config/config.php';
require_once dirname(__FILE__) . '/../Utils/fonctions.php';
$photo='';



 if (isset($_SESSION['user']['users_id'])){
    $users_id = (int) $_SESSION['user']['users_id'];
    $users = new users($users_id); 
    $usersViews = $users->readSingle();
    $photo = PICT_FOLDER.'pict-'.$users->users_id.'.'.$users->photo;
} 

 

require_once dirname(__FILE__).'/../View/navbar.php';