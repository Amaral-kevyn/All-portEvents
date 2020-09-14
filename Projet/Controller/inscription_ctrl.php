<?php 
session_start();

//Emplacement se connecter
if (isset($_GET['logout'])) {
    // vide le tableau session
    $_SESSION['user'] = [];
    // vide la variable session
    unset($_SESSION['user']);
    // détruit la session
    session_destroy();
}

if (isset($_POST['connexion']) && !empty($_POST['login1']) && !empty($_POST['passwordLogin'])) {
    $_SESSION['user'] = ['auth' => true, 'login1' => $_POST['login1']];
};


$civility = $lastname =$login=$email= $firstname =$password=$login1=$passwordLogin=$birthdate= $verifPassword = "";
$age = 0;
$errors = [];
$isSubmitted = false;
$regexNames = '/^[a-zéèîïêëç]+((?:\-|\s)[a-zéèéîïêëç]+)?$/i';
$regexPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/';
$regexTelephone = '/^(?:\+33|0033|0)[1-79]((?:([\-\/\s\.])?[0-9]){2}){4}$/';
$regexBirthday='/^((?:19|20)[0-9]{2})-((?:0[1-9])|(?:1[0-2]))-((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))$/';
$post=[];
$photo = $_COOKIE['picture'] ?? 'avatar.jpg';



//validation formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inscription'])) {
    $isSubmitted = true;

    $civility = filter_input(INPUT_POST, 'civility', FILTER_SANITIZE_NUMBER_INT);
    $filtercivility = filter_var($civility, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 2]]);
    if (empty($civility)) {
        $errors['civility'] = 'Veuillez sélectionner un genre!';

    } else if (!$filtercivility) { // équivaut écrire $filterCivility == 'false'
        $errors['civility'] = 'Veuillez renseigner le champs!';
    }
    array_push($post,$civility);
    // valider 
    $lastname = filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING);
    // vérifier la validité de la valeur
    if (empty($lastname)) {
        $errors['lastname'] = 'Veuillez renseigner votre nom';
    } else if (!preg_match($regexNames, $lastname)) {
        $errors['lastname'] = 'La valeur renseignée ne correspond pas au format attendu';
    }
    array_push($post,$lastname);

    // validation du firstname

    $firstname = filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING);
    // vérifier la validité de la valeur
    if (empty($firstname)) {
        $errors['firstname'] = 'Veuillez renseigner votre prenom';
    } else if (!preg_match($regexNames, $firstname)) {
        $errors['firstname'] = 'La valeur renseignée ne correspond pas au format attendu';
    }
    array_push($post,$firstname);

    $login = filter_input(INPUT_POST, 'login', FILTER_SANITIZE_STRING);
    // vérifier la validité de la valeur
    if (empty($login)) {
        $errors['login'] = 'Veuillez renseigner votre pseudo';
    } else if (!preg_match($regexNames, $login)) {
        $errors['login'] = 'La valeur renseignée ne correspond pas au format attendu';
    }
    array_push($post,$login);

    $birthdate = trim(filter_input(INPUT_POST, 'birthdate', FILTER_SANITIZE_STRING));
    	if (!empty($birthdate)) {
    		
    		// FIN

    		// créé le timestamp d'aujourd'hui
    		$today = strtotime("NOW");
    		// timestamp de mon input date
    		$convertBirthdate = strtotime($birthdate);
    		if (!preg_match($regexBirthday, $birthdate)) {
    			$errors['birthdate'] = 'Veuillez renseigner une date correcte';
            }
        
    		// vérifie que la date reste inférieur à NOW
    		elseif ($convertBirthdate > $today) {
    			$errors['birthdate'] = 'Votre date ne peut pas être supérieur à la date du jour';
    		}
    	}
    	else{
    		$errors['birthdate'] = 'Veuillez renseigner votre date de naissance';
        }
        $birthdate = preg_replace($regexBirthday,'$3/$2/$1',$birthdate);
        array_push($post,$birthdate);
        
    // validation du firstname

    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    // vérifier la validité de la valeur
    if (empty($email)) {
        $errors['email'] = 'Veuillez renseigner votre email';
    }
    array_push($post,$email);
    

    $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING);
    // vérifier la validité de la valeur
    if (empty($password)) {
        $errors['password'] = 'Veuillez renseigner votre mot de passe';
    } else if (!preg_match($regexPassword, $password)) {
        $errors['password'] = 'La valeur renseignée ne correspond pas au format attendu';
    }
    array_push($post,$password);

    $verifPassword = trim(filter_input(INPUT_POST, 'verifPassword', FILTER_SANITIZE_STRING));
    if (empty('verifPassword')) {
            $errors['verifPassword'] = 'Veuillez confirmer votre mot de passe';            
        } else if ($password != $verifPassword){
            $errors ['verifPassword'] = 'Les mots de passe ne correspondent pas';
        }  

        if (count($errors) == 0):
            $user = serialize($post);
            setcookie("user", $user, time()+3600);?>
            <div class="alert alert-success mt-5 h2 text-center" role="alert">Votre compte a été créé avec succès.</div>
            
       <?php endif;

}
require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../View/navbar.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/inscription.php';
