<?php
session_start();
$title = 'CatRoller';
// J'appelle les models requis pour la page
require_once dirname(__FILE__).'/../Models/User.php';
require_once dirname(__FILE__).'/../Models/department.php';
require_once dirname(__FILE__).'/../Models/events.php';
require_once dirname(__FILE__).'/../Models/typeOfEvents.php';
require_once dirname(__FILE__).'/../Models/activityOfEvents.php';
require_once dirname(__FILE__).'/../Models/villes_france.php';
require_once dirname(__FILE__).'/../Models/participate.php';
require_once dirname(__FILE__).'/../Models/post.php';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';
//Si l'utilisateur n'as pas de session , il est redirigé directement sur la page connexion
if (!isset($_SESSION['user'])) {
    header('location:../Controller/login_ctrl.php#loginPlacement'); 
}
//J'instancie la class 'events' du models events.php
$events = new events();
//Je nomme ma variable qui contient mon crud pour l'utiliser dans la view (Read pour cette exemple)
$eventsList = $events->readAllEvents();

// J'appelle les vues requis pour la page
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';
require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/CatRoller.php';

    