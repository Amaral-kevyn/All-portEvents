<?php session_start();
$title = 'profil Commentaire';
require_once dirname(__FILE__).'/../Models/User.php';
require_once dirname(__FILE__).'/../Models/post.php';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';

if($_SESSION['user']['admin'] == $moderateur){
    header('location: menu_ctrl.php?users_id='.$_SESSION['user']['admin']);
}  

if (!isset($_SESSION['user'])) {
    header('location:../Controller/login_ctrl.php#loginPlacement'); 
}

if (!isset($_GET['users_id']) && isset($_SESSION['user'])){
    header('location:../Controller/users_ctrl?users_id='.$_SESSION['user']['users_id']); 
}

$users_id = $_GET['users_id'];

$post = new post(0,'','',$users_id,'','','');
$usersPost = $post->readAllPost();

$user = new users($users_id);
$usersPostInfo = $user->readSingle();

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
    
    $users_id = $_GET['users_id'];
    $users_id_receive = $_SESSION['user']['users_id'];
    $sentNamePost = $_SESSION['user']['pseudo'];

    if ($isSubmitted && count($errors) == 0) {
        $post = new Post(0,'',$sentNamePost, $users_id, $users_id_receive,0,$contentPost);
        if ($post->createPost()) {
            $postCreated = true;
         header('location: PostUsers_ctrl.php?users_id='.$users_id); 
        }
    }
}

require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/postUsers.php';