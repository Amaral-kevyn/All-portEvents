<?php
require_once dirname(__FILE__) . '/../Models/User.php';
require_once dirname(__FILE__) . '/../Config/config.php';
require_once dirname(__FILE__) . '/../Utils/fonctions.php';
$photo='';

if (isset($_SESSION['user']['users_id'])){
    $users_id = (int) $_SESSION['user']['users_id'];
    $users = new users($users_id); 
    $usersPhoto = $users->readSingle();
    $photo = PICT_FOLDER.'pict-'.$usersPhoto->users_id.'.'.$usersPhoto->photo;
} 
require_once dirname(__FILE__).'/../View/navbar.php';