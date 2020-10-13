<?php session_start();
$title = 'profil utilisateur';
require_once dirname(__FILE__).'/../Models/User.php';
require_once dirname(__FILE__).'/../Models/department.php';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';

$users_id = (int) $_SESSION['user']['users_id'];
$users = new users($users_id);
$usersView = $users->readSingle();

if (!isset($_SESSION['user'])) {
    header('location:../Controller/login_ctrl.php#loginPlacement'); 
}

if (!isset($_GET['users_id']) && isset($_SESSION['user'])){
    header('location:../Controller/users_ctrl?users_id='.$_SESSION['user']['users_id']); 
}

if ($_SESSION['user']['users_id'] != $usersView->users_id){
    header('location:../Controller/listUsers_ctrl?users_id='.$_SESSION['user']['users_id']); 
} 

require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/users.php';