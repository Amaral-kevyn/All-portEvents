<?php 
session_start();
$title = 'liste et commentaire l utilisateur';
require_once dirname(__FILE__).'/../Models/User.php';
require_once dirname(__FILE__).'/../Models/department.php';
require_once dirname(__FILE__).'/../Models/events.php';
require_once dirname(__FILE__).'/../Models/typeOfEvents.php';
require_once dirname(__FILE__).'/../Models/activityOfEvents.php';
require_once dirname(__FILE__).'/../Models/villes_france.php';
require_once dirname(__FILE__).'/../Models/participate.php';
require_once dirname(__FILE__).'/../Models/post.php';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';

if (!isset($_SESSION['user'])) {
    header('location:../Controller/login_ctrl.php#loginPlacement'); 
}

$events_id = $_GET['events_id'];
$users_id= $_SESSION['user']['users_id'];

$post = new post(0,'','','','',$events_id,'');
$usersPostEvents = $post->readAllPostEvents();

$user = new users($users_id);
$usersPostInfo = $user->readSingle(); 

$participate = new participate(0,$events_id);
$eventsParticipate= $participate->getEvents();

//==== création des variables de regex ====//

//==== validation du formulaire ====//
$contentPost = '';
$isSubmitted = false;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isSubmitted = true;

    // ===== Content ====/
    $contentPost = trim(filter_input(INPUT_POST, 'contentPost', FILTER_SANITIZE_STRING));
    if (empty('contentPost')) {
        $errors['contentPost'] = 'Veuillez renseigner votre civilité!';
    }
    $users_id_receive= $_SESSION['user']['users_id'];
    $sentNamePost = $_SESSION['user']['pseudo'];
    $events_id = $_GET['events_id'];

    if ($isSubmitted && count($errors) == 0) {
        $post = new Post(0,'',$sentNamePost,0,$users_id_receive,$events_id,$contentPost);
        var_dump($post);
        if ($post->createPost()) {
            $postCreated = true;
          header('location: PostAndListEvents_ctrl.php?events_id='.$events_id);  
        }
    }
}

require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/postAndListEvents.php';