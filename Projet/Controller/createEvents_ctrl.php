<?php session_start();
require_once dirname(__FILE__).'/../Models/user.php';
require_once dirname(__FILE__).'/../Models/events.php';
require_once dirname(__FILE__).'/../Models/participate.php';
require_once dirname(__FILE__).'/../Models/typeOfEvents.php';
require_once dirname(__FILE__).'/../Models/activityOfEvents.php';

$title = 'Organiser evènement';

$location=$budget=$maxParticipant = $difficulty =$dateOfEvents= $dateOfPublication =$typeOfEvents_id=$users_id= "";
$errors = [];
$isSubmitted = false;
$post=[];

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
        $errors['maxParticipant'] = 'Veuillez renseigner votre prenom';
    } 
    array_push($post,$maxParticipant);

    $difficulty = trim(filter_input(INPUT_POST, 'difficulty', FILTER_SANITIZE_NUMBER_STRING));
    // vérifier la validité de la valeur
    if (empty($difficulty)) {
        $errors['difficulty'] = 'Veuillez renseigner votre prenom';
    }
    array_push($post,$difficulty);

    $dateOfEvents = trim(filter_input(INPUT_POST, 'dateOfEvents', FILTER_SANITIZE_STRING));
    // vérifier la validité de la valeur
    if (empty($dateOfEvents)) {
        $errors['dateOfEvents'] = 'Veuillez renseigner votre dateOfEvents';
     }/* else if (!preg_match($regexdateOfEvents, $dateOfEvents)) {
        $errors['dateOfEvents'] = 'La valeur renseignée ne correspond pas au format attendu';
    } */
    array_push($post,$dateOfEvents);

    $typeOfEvents_id = trim(filter_input(INPUT_POST, 'typeOfEvents_id', FILTER_SANITIZE_INT));
    if (empty($typeOfEvents_id)) {
        $errors['typeOfEvents_id'] = 'Veuillez renseigner votre typeOfEvents_id';
     }
    array_push($post,$typeOfEvents_id);

    
        if ($isSubmitted && count($errors) == 0){
            $event = new events(0,$location, $budget, $maxParticipant, $difficulty,$dateOfEvents,'','',$users_id);
            if ($event->create()) {
                $eventCreated = true;
                
            }
        }
            

}




require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname (__FILE__).'/../View/createEvents.php';