<?php session_start();
$title = 'Organiser evènement';
// J'appelle les models requis pour la page
require_once dirname(__FILE__).'/../Models/User.php';
require_once dirname(__FILE__).'/../Models/events.php';
require_once dirname(__FILE__).'/../Models/participate.php';
require_once dirname(__FILE__).'/../Models/typeOfEvents.php';
require_once dirname(__FILE__).'/../Models/activityOfEvents.php';
require_once dirname(__FILE__).'/../Models/villes_france.php';
require_once dirname(__FILE__).'/../Models/appartenir.php';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';

// Je déclare les variables en chaines vide pour qu'elles soient reconnus lors de la lecture de la page
$location=$budget=$maxParticipant=$contentEvent =$difficulty= $time=$dateOfEvents= $dateOfPublication =$typeOfEvents_id=$activityOfEvents_id='';
$errors = [];
$post =[];
// J'utilise une regex afin de sécurisé la saisie
$regexDate='/^((?:19|20)[0-9]{2})-((?:0[1-9])|(?:1[0-2]))-((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))$/';
// J'utilise ajax et pour ce faire je vérifie si le post typeEve et TypeOfEvents sont existant
if(isset($_POST['typeEve']) && isset($_POST['typeOfEvents'])){
    $type = $_POST['typeOfEvents'];
    $activityAll = array();

    $appartenir = new appartenir();
    $appartenir->typeOfEvents_id = $type;
    $activityAll = $appartenir->getActivity();
    echo json_encode($activityAll);
    exit();
}

if(isset($_POST['codePS']) && isset($_POST['ville_code_postal'])){
    $cpField = $_POST['ville_code_postal'];
    $villes = array();

    $villes_france = new villes_france();
    $villes_france->ville_code_postal = $cpField;
    $villes = $villes_france->getVilles();
    echo json_encode($villes);
    exit();
} 
//si l'utilisateur n'as pas de session , il est redirigé vers la page connexion
if (!isset($_SESSION['user'])) {
    header('location:../Controller/login_ctrl.php#loginPlacement'); 
}
//si l'utilisateur as une session 'MODERATEUR', il est redirigé vers la page Liste des utilisateurs
if($_SESSION['user']['admin'] == $moderateur){
    header('location: ../Controller/listUsers_ctrl.php?users_id='.$_SESSION['user']['users_id']);
    exit();
}  
//J'instancie la class 'events' du models events.php
$TypeOfEvents = new typeOfEvents();
//Je nomme ma variable qui contient mon crud pour l'utiliser dans la vue (Read pour cette exemple)
$resultsEvents = $TypeOfEvents->readAllTypeOfEvents();

//je créer un drapeau pour sécurisé la validité du traitement , si il a bien soumis le formulaire
$isSubmitted = false;

//validation formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['create'])) {
    $isSubmitted = true;

    $location = trim(filter_input(INPUT_POST, 'location', FILTER_SANITIZE_STRING));
    if (empty($location)) {
        $errors['location'] = 'Veuillez sélectionner une adresse';
    } 
    array_push($post,$location);
   
    // validation de la l'adresse apres un vérification de sécurité , s'il il a bien été rempli

    $budget = trim(filter_input(INPUT_POST, 'budget', FILTER_SANITIZE_NUMBER_INT));
    // vérifier la validité de la valeur
    if (empty($budget)) {
        $errors['budget'] = 'Veuillez renseigner le budget de l\'évènement';
    } 
    array_push($post,$budget);

     // validation de le budget apres un vérification de sécurité , s'il il a bien été rempli

    $maxParticipant = trim(filter_input(INPUT_POST, 'maxParticipant', FILTER_SANITIZE_NUMBER_INT));
    // vérifier la validité de la valeur
    if (empty($maxParticipant)) {
        $errors['maxParticipant'] = 'Veuillez renseigner le nombre de participant maximum';
    } 
    array_push($post,$maxParticipant);

    // validation de le N° Max de participant apres un vérification de sécurité , s'il il a bien été rempli

    $difficulty = trim(filter_input(INPUT_POST, 'difficulty', FILTER_SANITIZE_NUMBER_INT));
    // vérifier la validité de la valeur
    if (empty($difficulty)) {
        $errors['difficulty'] = 'Veuillez renseigner le niveau de difficulté';
    }
    array_push($post,$difficulty);

    // validation de la difficulté apres un vérification de sécurité , s'il il a bien été rempli

    $time = trim(filter_input(INPUT_POST, 'appt', FILTER_SANITIZE_STRING));
    // vérifier la validité de la valeur
    if (empty($time)) {
        $errors['appt'] = 'Veuillez renseigner l\'heure de l\'événement';
    }
    array_push($post,$time);

    // validation de l'heure apres un vérification de sécurité , s'il il a bien été rempli

    $dateOfEvents = trim(filter_input(INPUT_POST, 'dateOfEvents', FILTER_SANITIZE_STRING));
    if (!empty($dateOfEvents)) {
        
    // validation de la date de l'événement apres un vérification de sécurité , s'il il a bien été rempli

        // créé le timestamp d'aujourd'hui
        $today = strtotime("NOW");
        // timestamp de mon input date
        $convertdateOfEvents = strtotime($dateOfEvents);
        if (!preg_match($regexDate, $dateOfEvents)) {
            $errors['dateOfEvents'] = 'Veuillez renseigner une date correcte';
        }
    
        // vérifie que la date reste superieur à NOW
        elseif ($convertdateOfEvents < $today) {
            $errors['dateOfEvents'] = 'Votre date ne peut pas être inférieur à la date du jour';
        }
    }
    else{
        $errors['dateOfEvents'] = 'Veuillez renseigner votre date de naissance';
    }
    //Date événement
    array_push($post,$dateOfEvents);

    $contentEvent = trim(filter_input(INPUT_POST, 'contentEvent', FILTER_SANITIZE_STRING));
    if (empty($contentEvent)) {
        $errors['contentEvent'] = 'Veuillez renseigner  le déscriptif de l\'évènement';
     }
    array_push($post,$contentEvent);

    // validation du contenu apres un vérification de sécurité , s'il il a bien été rempli

     $users_id = $_SESSION['user']['users_id'];
     $type = $_POST['typeOfEvents'];
     $cpField = $_POST['ville_code_postal'];
     $activityOfEvents_id = $_POST['activityOfEvents'];
    
    //Vérification et si il n'y a pas d'erreur je lance la création de l'événement apres avoir instancier la class events
    if ($isSubmitted && count($errors) == 0){
        $events = new events(0,$location,$budget,$maxParticipant,$difficulty,$dateOfEvents,'',$type,$users_id,$activityOfEvents_id,$cpField,$contentEvent,$time);
        if ($events->createEvents()) {
            $eventCreated = true;    
        }
    }
}

require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/createEvents.php';