<?php
session_start();
$title = 'Se connecter';
require_once dirname(__FILE__) . '/../Models/User.php';

if (isset($_GET['logout'])) {
    // vide le tableau session
    $_SESSION['user'] = [];
    // vide la variable session
    unset($_SESSION['user']);
    // détruit la session
    session_destroy();
    header('location: ../Connexion#loginPlacement');
}
// Je déclare les variables en chaines vide pour qu'elles soient reconnus lors de la lecture de la page
$email = '';
$password = '';
$emailExist = "";
$isSubmitted = false;
$success = false;

// Vérification du formulaires
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['connexion'])) {
    $isSubmitted = true;
    if (isset($email) && isset($password)) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        if (empty($email)) {
            $errors['email'] = 'Veuillez renseigner votre adresse email !';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors['email'] = 'Le champs n\'est pas valide!';
        } else {
            $errors['email'] = 'L\'email ne correspond pas à votre profil !';
        }

        if (empty($password)) {
            $errors['password'] = 'Merci de mettre ton mot de passe !';
        } else {
            $errors['password'] = 'Le mot de passe ne correspond pas à votre profil !';
        }

        $user = new users();
        $user->email = $email;
        $user->password = $password;

        //Si la vérification est bonne et sans erreur , je créé une session contenant le pseudo,email,role,et l'identifiant
        if($user->connect()) {
            $userCo = $user->connect();

            if(password_verify($password,$userCo->password)){
                $_SESSION['user']['auth'] = true;
                $_SESSION['user']['users_id'] = $userCo->users_id;
                $_SESSION['user']['email'] = $userCo->email;
                $_SESSION['user']['pseudo'] = $userCo->pseudo; 
                $_SESSION['user']['admin'] = $userCo->admin_id; 
                $success =true;
                 header('location:../Controller/users_ctrl.php?users_id='.$_SESSION['user']['users_id']); 
            }
            //Sinon un message d'erreur apparait et ne valide pas l'inscription
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
