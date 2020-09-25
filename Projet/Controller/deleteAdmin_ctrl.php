<?php session_start();
$title = 'Supprimer un utilisateur';
require_once dirname(__FILE__).'/../Models/User.php';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';

if($_SESSION['user']['admin'] != $admin){
    header('location: login_ctrl.php');
    exit();
}

if (empty($_GET['users_id']) && empty($_POST['users_id'])) {
    header('location: listUsers_ctrl.php');
    exit();
}

if (isset($_GET['users_id'])) {
    $users_id = (int) $_GET['users_id'];
    $users = new users($users_id);
    $usersInfos = $users->readSingle();
    $fullName = $usersInfos->lastname.' '.$usersInfos->firstname;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users_id = (int) $_POST['users_id'];
    $fullName = $_POST['fullName'];
    $users = new users($users_id);
        if ($users->delete()) {
            $deleteUsersSuccess = true;
            header('location: listUsers_ctrl.php');
        }
}

require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname (__FILE__).'/../View/deleteUsers.php';