<?php 
session_start();
require_once dirname(__FILE__).'/../Models/user.php';
$title = 'liste des utilisateurs';


$users = new Users();
$usersList = $users->readAll();


require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../View/navbar.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/listUsers.php';