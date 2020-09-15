<?php session_start();
require_once dirname(__FILE__).'/../Models/user.php';
$title = 'profil utilisateur';

if (!isset($_SESSION['user'])) {
    header('location:../Controller/login_ctrl.php#loginPlacement'); 
}

if (!isset($_GET['users_id']) && isset($_SESSION['user'])){
    
    header('location:../Controller/users_ctrl?users_id='.$_SESSION['user']['users_id']); 

}

    $users_id = (int) $_SESSION['user']['users_id'];
    $users = new Users($users_id);
    $usersView = $users->readSingle();



require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/users.php';