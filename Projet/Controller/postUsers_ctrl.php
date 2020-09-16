<?php session_start();
require_once dirname(__FILE__).'/../Models/user.php';
require_once dirname(__FILE__).'/../Models/post.php';
$title = 'profil Commentaire';

if (!isset($_SESSION['user'])) {
    header('location:../Controller/login_ctrl.php#loginPlacement'); 
}

if (!isset($_GET['users_id']) && isset($_SESSION['user'])){
    
    header('location:../Controller/users_ctrl?users_id='.$_SESSION['user']['users_id']); 

}

$users_id = $_GET['users_id'];

$users = new Users();
$usersPost = $users->readAllPost();

$user = new Users($users_id);
$usersPostInfo = $user->readSingle();




//==== création des variables de regex ====//

//==== validation du formulaire ====//
$contentPost = '';
$isSubmitted = false;
$errors = [];
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $isSubmitted = true;
    // ==== validation des champs ====//

    //**********INFORMATION SUR LA PERSONNE**********//
    // ===== Content ====/
    $contentPost = trim(filter_input(INPUT_POST, 'contentPost', FILTER_SANITIZE_STRING));
    if (empty('contentPost')) {
        $errors['contentPost'] = 'Veuillez renseigner votre civilité!';
    }
    
    $users_id = $_GET['users_id'];
    $users_id_receive = $_SESSION['user']['users_id'];
    $sentNamePost = $_SESSION['user']['pseudo'];

if ($isSubmitted && count($errors) == 0) {
    $user = new Users(0,'',$sentNamePost, $users_id, $users_id_receive,0,$contentPost);
    if ($user->createPost()) {
        $postCreated = true;

    }
}}

require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/postUsers.php';