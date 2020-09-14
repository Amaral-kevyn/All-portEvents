<?php session_start();
require_once dirname(__FILE__).'/../Models/user.php';
$title = 'profil utilisateur';

if (!isset($_SESSION['user'])) {
    header('location:../Controller/login_ctrl.php'); 
}

if (!isset($_GET['user_id']) && isset($_SESSION['user']) ){
    
    header('location:../Controller/users_ctrl?user_id='.$_SESSION['user']['users_id']); 

}

    $user_id = (int) $_SESSION['user']['users_id'];
    $users = new Users($user_id);
    $usersView = $users->readSingle();



require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../View/navbar.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/users.php';