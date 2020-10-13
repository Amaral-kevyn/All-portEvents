<?php 
session_start();
$title = 'S\'incrire';
require_once dirname(__FILE__).'/../Models/User.php';
require_once dirname(__FILE__).'/../Models/department.php';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';

//declaration de variable
$civility=$departmentNumber=$emailExist=$pseudoExist = $lastname =$email= $firstname =$hashed_password=$pseudo=$password=$birthdate= $verifPassword = "";
//Tableau d'erreur
$errors = [];
//drapeau
$isSubmitted = false;
//Regex
$regexNames = '/^[a-zéèîïêëç]+((?:\-|\s)[a-zéèéîïêëç]+)?$/i';
/* $regexPseudo = '/^([a-zA-Z0-9-_]{2,36})/$'; */
$regexPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/';
$regexTelephone = '/^(?:\+33|0033|0)[1-79]((?:([\-\/\s\.])?[0-9]){2}){4}$/';
$regexBirthday='/^((?:19|20)[0-9]{2})-((?:0[1-9])|(?:1[0-2]))-((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))$/';
$regexzipCode= '/^(?:[0-8]\d|9[0-8])\d{3}$/';
//tableau de toute les variables
$post=[];

if(isset($_POST['ajaxCP']) && isset($_POST['departmentCode'])){ 
    $departmentNumber = $_POST['departmentCode'];
    $departmentAll = array();

    $department = new department();
    $department->departmentCode = $departmentNumber;
    $departmentAll = $department->getDepartment();
    echo json_encode($departmentAll); 
    exit(); 
 } 

//validation formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['inscription'])) {
    $isSubmitted = true;

    //Civilité
    $civility = trim(filter_input(INPUT_POST, 'civility', FILTER_SANITIZE_NUMBER_INT));
    $filtercivility = filter_var($civility, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 2]]);
    if (empty($civility)) {
        $errors['civility'] = 'Veuillez sélectionner un genre!';

    } else if (!$filtercivility) { // équivaut écrire $filterCivility == 'false'
        $errors['civility'] = 'Veuillez renseigner le champs!';
    }
    array_push($post,$civility);
    //Civilité

    //Nom de famille
    $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
    // vérifier la validité de la valeur
    if (empty($lastname)) {
        $errors['lastname'] = 'Veuillez renseigner votre nom';
    } else if (!preg_match($regexNames, $lastname)) {
        $errors['lastname'] = 'La valeur renseignée ne correspond pas au format attendu';
    }
    array_push($post,$lastname);
    //Nom de famille

    //Prénom
    $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
    // vérifier la validité de la valeur
    if (empty($firstname)) {
        $errors['firstname'] = 'Veuillez renseigner votre prenom';
    } else if (!preg_match($regexNames, $firstname)) {
        $errors['firstname'] = 'La valeur renseignée ne correspond pas au format attendu';
    }
    array_push($post,$firstname);
    //Prénom

    //Pseudo
    $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING));
    // vérifier la validité de la valeur
    if (empty($pseudo)) {
        $errors['pseudo'] = 'Veuillez renseigner votre pseudo';
     }
     $users = new Users('','','','','',$pseudo);
     $usersPseudo = $users->readPregMatchPseudo();
     
     foreach ($usersPseudo as $pseudo2) {
         $pseudoExist = $pseudo2->pseudo;
     }
     
     if ($pseudo == $pseudoExist) {
         $errors['pseudo'] = 'Votre pseudo existe déja';
     }
    array_push($post,$pseudo);
    //Pseudo

    //Date de naissance
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
        array_push($post,$birthdate);
        //Date de naissance
        
    //Email
    $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
    // vérifier la validité de la valeur
    if (empty($email)) {
        $errors['email'] = 'Veuillez renseigner votre email';
    }
    $users = new Users('','','','',$email);
    $usersMail = $users->readPregMatchMail();
    //Verification si l'email est déja en base de données
    foreach ($usersMail as $email2) {
        $emailExist = $email2->email;
    }
    
    if ($email == $emailExist) {
        $errors['email'] = 'Votre email existe déja';
    }
    array_push($post,$email);
    //Email
    
    //Mot de passe
    $password = trim(filter_input(INPUT_POST, 'password', FILTER_SANITIZE_STRING));
    // vérifier la validité de la valeur
    if (empty($password)) {
        $errors['password'] = 'Veuillez renseigner votre mot de passe';
    } else if (!preg_match($regexPassword, $password)) {
        $errors['password'] = 'La valeur renseignée ne correspond pas au format attendu';
    }
    //Mot de passe
  
    //Verification  Mot de passe
    $verifPassword = trim(filter_input(INPUT_POST, 'verifPassword', FILTER_SANITIZE_STRING));
    if (empty('verifPassword')) {
        $errors['verifPassword'] = 'Veuillez confirmer votre mot de passe';            
    } else if ($password != $verifPassword){
        $errors ['verifPassword'] = 'Les mots de passe ne correspondent pas';
    } else {
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);
    }
    array_push($post,$hashed_password);
    //Verification  Mot de passe

    //Verification  CGU
    if (!isset($_POST['cgu'])) {
        $errors['cgu'] = 'Veuillez cocher la case pour envoyer le formulaire.';
    }
    //Verification  CGU
    $departmentNumber = $_POST['departmentCode'];
    $roles_id = $utilisateur;
    //Validation et creation de l'utilisateur
    if ($isSubmitted && count($errors) == 0){
        $users = new users(0,$lastname, $firstname, $birthdate, $email,$pseudo, $hashed_password,'',$civility,0,'','',$roles_id,$departmentNumber);
        if ($users->create()) {
            $userCreated = true;
            //Redirection apres validation de la création de l'utilisateur 
             header('location:../Controller/login_ctrl.php#loginPlacement');    
        }
    }       
}

require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/subscribe.php';
