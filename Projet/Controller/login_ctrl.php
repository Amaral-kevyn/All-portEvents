<?php
session_start();
require_once dirname(__FILE__) . '/../Models/user.php';

if (isset($_GET['logout'])) {
    // vide le tableau session
    $_SESSION['user'] = [];
    // vide la variable session
    unset($_SESSION['user']);
    // détruit la session
    session_destroy();
    header('location: ../Connexion#loginPlacement');
}

$title = 'se connecter';
$email = '';
$password = '';
$emailExist = "";
$isSubmitted = false;
$success = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connexion'])) {
    $isSubmitted = true;
    if (isset($email) && isset($password)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email)) {
            $errors['email'] = 'Veuillez renseigner votre adresse email !';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Le champs n\'est pas valide!';
        }if (empty($password)) {
            $errors['password'] = 'Merci de mettre ton mot de passe !';
        }
        $user = new Users();
        $user->email = $email;
        $user->password = $password;

        
        if($user->connect()) {
            $userCo = $user->connect();

            if(password_verify($password,$userCo->password)){
                $_SESSION['user']['auth'] = true;
                $_SESSION['user']['users_id'] = $userCo->users_id;
                $_SESSION['user']['email'] = $userCo->email;
                $_SESSION['user']['pseudo'] = $userCo->pseudo; 
                $success =true;
                header('location:../Controller/users_ctrl.php?users_id='.$_SESSION['user']['users_id']);
            }
            else{
                $errors['email'] = 'votre email ou votre mot de passe est incorrect!';
                $success = false;
            }
        }

    }

}



require_once dirname(__FILE__) . '/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__) . '/../View/navbarBottom.php';
require_once dirname(__FILE__) . '/../View/login.php';