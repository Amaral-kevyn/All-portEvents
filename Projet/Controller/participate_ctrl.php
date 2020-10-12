<?php session_start();
$title = 'Inscription événement';
require_once dirname(__FILE__).'/../Models/User.php';
require_once dirname(__FILE__).'/../Models/events.php';
require_once dirname(__FILE__).'/../Models/participate.php';
require_once dirname(__FILE__).'/../Models/typeOfEvents.php';
require_once dirname(__FILE__).'/../Models/activityOfEvents.php';
require_once dirname(__FILE__).'/../Models/villes_france.php';
require_once dirname(__FILE__).'/../Models/appartenir.php';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';

$events_id = $_GET['events_id'];
if (!isset($_SESSION['user'])) {
    header('location:../Controller/login_ctrl.php#loginPlacement'); 
}

if($_SESSION['user']['admin'] == $moderateur){
    header('location: ../Controller/listUsers_ctrl.php?users_id='.$_SESSION['user']['users_id']);
    exit();
}  

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $users_id = $_SESSION['user']['users_id'];
    $events_id = $_POST['events_id'];
    $participate = new participate($users_id,$events_id);
    var_dump($participate);
        if ($participate->createListEvents()) {
            $createListEventsSuccess = true;
              header('location: myParticipation_ctrl.php?users_id='.$_SESSION['user']['users_id']);  
        }
}

require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/listParticipate.php';