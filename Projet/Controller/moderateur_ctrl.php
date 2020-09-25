<?php session_start();
$title = 'Moderateur Commentaire';
require_once dirname(__FILE__).'/../Models/user.php';
require_once dirname(__FILE__).'/../Models/post.php';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';


if ($_SESSION['user']['admin'] == $moderateur || $_SESSION['user']['admin'] == $admin ){
    $users_id = $_GET['users_id'];

    $post = new post();
    $usersPostModerateur = $post->readAllPostModerateur();
    
    $user = new users($users_id);
    $usersPostInfo = $user->readSingle();
       
}else{
    header('location:../Controller/login_ctrl.php?users_id='.$_SESSION['user']['users_id'].'#loginPlacement');
}  

if (!isset($_SESSION['user'])) {
    header('location:../Controller/login_ctrl.php#loginPlacement'); 
}

if (!isset($_GET['users_id']) && isset($_SESSION['user'])){
    
    header('location:../Controller/users_ctrl?users_id='.$_SESSION['user']['users_id']); 
}

require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/moderateur.php';
