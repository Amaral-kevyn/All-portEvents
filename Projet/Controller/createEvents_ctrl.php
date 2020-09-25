<?php session_start();
$title = 'Organiser evènement';
require_once dirname(__FILE__).'/../Models/User.php';
require_once dirname(__FILE__).'/../Models/events.php';
require_once dirname(__FILE__).'/../Models/participate.php';
require_once dirname(__FILE__).'/../Models/typeOfEvents.php';
require_once dirname(__FILE__).'/../Models/activityOfEvents.php';
require_once dirname(__FILE__).'/../Models/villes_france.php';
require_once dirname(__FILE__).'/../Models/appartenir.php';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';

if (!isset($_SESSION['user'])) {
    header('location:../Controller/login_ctrl.php#loginPlacement'); 
}

if($_SESSION['user']['admin'] == $moderateur){
    header('location: ../Controller/listUsers_ctrl.php?users_id='.$_SESSION['user']['users_id']);
    exit();
}  

$TypeOfEvents = new typeOfEvents();
$resultsEvents = $TypeOfEvents->readAllTypeOfEvents();

$location='29 rue';$budget='2';$maxParticipant='4';$contentEvent ='tamere'; $difficulty ='2';$dateOfEvents='1987/01/01'; $dateOfPublication ='';$typeOfEvents_id='1';$activityOfEvents_id='2';$ville_code_postal='4';$users_id='1';$cpField= "5";
$errors = [];
$post =[];
/* 
if($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['typeOfEvents']))){
    $type = $_POST['typeOfEvents'];
    $activityAll = array();

    $appartenir = new appartenir();
    $appartenir->typeOfEvents_id = $type;
    $activityAll = $appartenir->getActivity();
    echo json_encode($activityAll);
    exit();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && (isset($_POST['ville_code_postal']))){
    $cpField = $_POST['ville_code_postal'];
    $villes = array();

    $villes_france = new villes_france();
    $villes_france->ville_code_postal = $cpField;
    $villes = $villes_france->getVilles();
    echo json_encode($villes);
    exit();
} */

$isSubmitted = false;
//validation formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $isSubmitted = true;


    $location = trim(filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING));
    if (empty($location)) {
        $errors['location'] = 'Veuillez sélectionner une adresse';
    } 
    array_push($post,$location);

   
    // valider 

    $budget = trim(filter_input(INPUT_POST, 'budget', FILTER_SANITIZE_NUMBER_INT));
    // vérifier la validité de la valeur
    if (empty($budget)) {
        $errors['budget'] = 'Veuillez renseigner le budget de l\'évènement';
    } 
    array_push($post,$budget);

    // validation du $maxParticipant

    $maxParticipant = trim(filter_input(INPUT_POST, 'maxParticipant', FILTER_SANITIZE_NUMBER_INT));
    // vérifier la validité de la valeur
    if (empty($maxParticipant)) {
        $errors['maxParticipant'] = 'Veuillez renseigner le nombre de participant maximum';
    } 
    array_push($post,$maxParticipant);

    $difficulty = trim(filter_input(INPUT_POST, 'difficulty', FILTER_SANITIZE_NUMBER_INT));
    // vérifier la validité de la valeur
    if (empty($difficulty)) {
        $errors['difficulty'] = 'Veuillez renseigner le niveau de difficulté';
    }
    array_push($post,$difficulty);

    $dateOfEvents = trim(filter_input(INPUT_POST, 'dateOfEvents', FILTER_SANITIZE_STRING));
    // vérifier la validité de la valeur
    if (empty($dateOfEvents)) {
        $errors['dateOfEvents'] = 'Veuillez renseigner la date de l\'évènement';
     }
    array_push($post,$dateOfEvents);


    $activityOfEvents_id = trim(filter_input(INPUT_POST, 'activityOfEvents', FILTER_SANITIZE_NUMBER_INT));
    if (empty($activityOfEvents_id)) {
        $errors['activityOfEvents'] = 'Veuillez renseigner  la l\'activité de l\évènement';
     }
    array_push($post,$activityOfEvents_id);


    $contentEvent = trim(filter_input(INPUT_POST, 'contentEvent', FILTER_SANITIZE_STRING));
    if (empty($contentEvent)) {
        $errors['contentEvent'] = 'Veuillez renseigner  le déscriptif de l\évènement';
     }
    array_push($post,$contentEvent);
var_dump($_POST);
    
    if ($isSubmitted && count($errors) == 0){
        $events = new events(0,$location,$budget,$maxParticipant,$difficulty,$dateOfEvents,$typeOfEvents_id,$users_id,$activityOfEvents_id,$cpField,$contentEvent);
        if ($events->createEvents()) {
            $eventCreated = true;    
        }
    }
}


require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/createEvents.php';