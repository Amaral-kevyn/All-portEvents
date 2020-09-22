<?php session_start();
require_once dirname(__FILE__).'/../Models/user.php';
require_once dirname(__FILE__).'/../Models/events.php';
require_once dirname(__FILE__).'/../Models/participate.php';
require_once dirname(__FILE__).'/../Models/typeOfEvents.php';
require_once dirname(__FILE__).'/../Models/activityOfEvents.php';
require_once dirname(__FILE__).'/../Models/villes_france.php';
require_once dirname(__FILE__).'/../Models/appartenir.php';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';

$title = 'Organiser evènement';

if($_SESSION['user']['admin'] == $moderateur){
    header('location: ../Controller/listUsers_ctrl.php?users_id='.$_SESSION['user']['users_id']);
    exit();
   } 

   $typeOfEvent = new typeOfEvents();
   $resultsEvents = $typeOfEvent->readAllTypeOfEvents();


$location=$budget=$maxParticipant = $difficulty =$dateOfEvents= $dateOfPublication =$typeOfEvents_id=$activityOfEvents_id=$users_id= "";
$errors = [];
$isSubmitted = false;
$post=[];



if(isset($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['ville_code_postal'])){
    $cpField = $_POST['ville_code_postal'];
    $villes = array();

    $villes_france = new villes_france();
    $villes_france->ville_code_postal = $cpField;
    $villes = $villes_france->getVilles();
    echo json_encode($villes);
    exit();
    }

if(isset($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['typeOfEvents'])){
    $type = $_POST['typeOfEvents'];
    $activityAll = array();

    $appartenir = new appartenir();
    $appartenir->typeOfEvents_id = $type;
    $activityAll = $appartenir->getActivity();
    echo json_encode($activityAll);
    exit();
    }

//validation formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $isSubmitted = true;

    $users_id = $_SESSION['user']['users_id'];

    $location = trim(filter_input(INPUT_POST, 'location', FILTER_SANITIZE_NUMBER_INT));
    if (empty($location)) {
        $errors['location'] = 'Veuillez sélectionner une adresse';

    } 
    array_push($post,$location);

   
    // valider 

    $budget = trim(filter_input(INPUT_POST, 'budget', FILTER_SANITIZE_STRING));
    // vérifier la validité de la valeur
    if (empty($budget)) {
        $errors['budget'] = 'Veuillez renseigner le budget de l\'évènement';
    } 
    array_push($post,$budget);

    // validation du $maxParticipant

    $maxParticipant = trim(filter_input(INPUT_POST, 'maxParticipant', FILTER_SANITIZE_STRING));
    // vérifier la validité de la valeur
    if (empty($maxParticipant)) {
        $errors['maxParticipant'] = 'Veuillez renseigner le nombre de participant maximum';
    } 
    array_push($post,$maxParticipant);

    $difficulty = trim(filter_input(INPUT_POST, 'difficulty', FILTER_SANITIZE_NUMBER_STRING));
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

    $typeOfEvents_id = trim(filter_input(INPUT_POST, 'typeOfEvents', FILTER_SANITIZE_INT));
    if (empty($typeOfEvents_id)) {
        $errors['typeOfEvents'] = 'Veuillez renseigner la catégorie de l\évènement';
     }
    array_push($post,$typeOfEvents_id);

    $activityOfEvents_id = trim(filter_input(INPUT_POST, 'typeOfEvents', FILTER_SANITIZE_INT));
    if (empty($typeOfEvents_id)) {
        $errors['typeOfEvents'] = 'Veuillez renseigner  la l\'activité de l\évènement';
     }
    array_push($post,$typeOfEvents_id);

    $users_id = $_SESSION['user']['users_id'];

    
        if ($isSubmitted && count($errors) == 0){
            $event = new events(0,$location, $budget, $maxParticipant, $difficulty,$dateOfEvents,$typeOfEvents_id,$activityOfEvents_id,$users_id,$cpField);
            if ($event->create()) {
                $eventCreated = true;
                
            }
        }
            

}




require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname (__FILE__).'/../View/createEvents.php';