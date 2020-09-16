<?php session_start();
require_once dirname(__FILE__).'/../Models/user.php';
require_once dirname(__FILE__).'/../Models/post.php';
$title = 'Supprimer un commentaire';
$users_id = $_SESSION['user']['users_id'];

  /*  if($_SESSION['user']['admin'] != '120854' || $_SESSION['user']['admin'] != '83714') {
    header('location: login_ctrl.php');
    exit();
}   */
 
 if (empty($_GET['users_id']) && empty($_POST['users_id'])) {
    header('location: listUsers_ctrl.php');
    exit();
} 
if (!empty($_GET['post_id']) || !empty($_POST['post_id'])) {
    $post_id = $_POST['post_id'] ?? $_GET['post_id'];
    $post = new Post($post_id);
    $postInfos = $post->readPost();
    $fullName = $postInfos->sentNamePost.' '.'du'.' '.$postInfos->dateOfPost;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $post_id = (int) $_POST['post_id'];
    $fullName = $_POST['fullName'];
    $post = new Post($post_id);
        if ($post->deletePost()) {
            $deletePostSuccess = true;
            header('location: postUsers_ctrl.php?users_id='.$_SESSION['user']['users_id']);
        }
}



require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname (__FILE__).'/../View/deletePost.php';