<?php session_start();
require_once dirname(__FILE__).'/../Models/user.php';
require_once dirname(__FILE__).'/../Models/post.php';
$title = 'Supprimer un commentaire';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';
$users_id = $_SESSION['user']['users_id'];

if($_SESSION['user']['admin'] == $moderateur || $_SESSION['user']['admin'] == $admin) {
 
  
 
 if (empty($_GET['users_id']) && empty($_POST['users_id'])) {
    header('location: listUsers_ctrl.php');
    exit();
} 
if (!empty($_GET['post_id']) || !empty($_POST['post_id'])) {
    $post_id = $_POST['post_id'] ?? $_GET['post_id'];
    $post = new post($post_id);
    $postInfos = $post->readPost();
    $fullName = $postInfos->sentNamePost.' '.'du'.' '.$postInfos->dateOfPost;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = (int) $_POST['post_id'];
    $fullName = $_POST['fullName'];
    $post = new post($post_id);
        if ($post->deletePost()) {
            $deletePostSuccess = true;
            header('location: listUsers_ctrl.php?users_id='.$_SESSION['user']['users_id']);
            exit();
        }
}

}

require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname (__FILE__).'/../View/deletePost.php';