<?php session_start();
$title = 'Modifier mon profil';
require_once dirname(__FILE__).'/../Models/User.php';
require_once dirname(__FILE__).'/../Models/department.php';
require_once dirname(__FILE__).'/../Config/config.php';
require_once dirname(__FILE__).'/../Utils/fonctions.php';
require_once dirname(__FILE__).'/../Controller/role_ctrl.php';
//Utilisation d'ajax pour le code postale
if(isset($_POST['ajaxDP']) && isset($_POST['departmentCode'])){ 
    $departmentNumber = $_POST['departmentCode'];
    $departmentAll = array();

    $department = new department();
    $department->departmentCode = $departmentNumber;
    $departmentAll = $department->getDepartment();
    echo json_encode($departmentAll); 
    exit(); 
 }

 $extension = '';
if($_SESSION['user']['admin'] == $moderateur){
    header('location: menu_ctrl.php?users_id='.$_SESSION['user']['admin']);
} 
/* if ($_SESSION['user']['admin'] == '83714'){
    header('location:../Controller/listUsers_ctrl?users_id='.$_SESSION['user']['users_id']); 
} */

if (empty($_GET['users_id']) && empty($_POST['users_id'])){
    header('location:users_ctrl.php');
    exit();
}
//Je récupère soit par POST ou GET pour effectuer le traitement
if (!empty($_GET['users_id']) || !empty($_POST['users_id'])) {
    $users_id = $_POST['users_id'] ?? $_GET['users_id'];
    $users = new users($users_id);
    $usersInfos = $users->readSingle();
    $users_id = $usersInfos->users_id; 
    $firstname = $usersInfos->firstname;
    $lastname = $usersInfos->lastname;
    $birthdate = $usersInfos->birthdate_format;
    $email = $usersInfos->email;
    $civility = $usersInfos->civility;
    $pseudo = $usersInfos->pseudo;
    $photo = $usersInfos->photo;
    $department_id = $usersInfos->department_id;
}

 if ($_SESSION['user']['users_id'] != $usersInfos->users_id){
    header('location:../Controller/listUsers_ctrl?users_id='.$_SESSION['user']['users_id']); 
} 

//validation des champs 
$errors = [];
$isSubmitted = false;
$regexNames = '/^[a-zéèîïêëç]+((?:\-|\s)[a-zéèéîïêëç]+)?$/i';
/* $regexPseudo = '/^([a-zA-Z0-9-_]{2,36})/$'; */
$regexPassword = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9])(?=.*\W).{8,}$/';
$regexTelephone = '/^(?:\+33|0033|0)[1-79]((?:([\-\/\s\.])?[0-9]){2}){4}$/';
$regexBirthday='/^((?:19|20)[0-9]{2})-((?:0[1-9])|(?:1[0-2]))-((?:0[1-9])|(?:1[0-9])|(?:2[0-9])|(?:3[01]))$/';
$regexzipCode= '/^(?:[0-8]\d|9[0-8])\d{3}$/';
$post=[];



    
//validation formulaire
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['Modifier'])) {
    $isSubmitted = true;

        $users_id = (int) $_POST['users_id'];
        $departmentNumber = $_POST['departmentCode'];
    
        ///--------------------------------------------
        $civility = trim(filter_input(INPUT_POST, 'civility', FILTER_SANITIZE_NUMBER_INT));
        $filtercivility = filter_var($civility, FILTER_VALIDATE_INT, ["options" => ["min_range" => 1, "max_range" => 2]]);
        if (empty($civility)) {
            $errors['civility'] = 'Veuillez sélectionner un genre!';
    
        } else if (!$filtercivility) { // équivaut écrire $filterCivility == 'false'
            $errors['civility'] = 'Veuillez renseigner le champs!';
        }
        array_push($post,$civility);
        // valider 
        ///--------------------------------------------

        ///--------------------------------------------
        $lastname = trim(filter_input(INPUT_POST, 'lastname', FILTER_SANITIZE_STRING));
        // vérifier la validité de la valeur
        if (empty($lastname)) {
            $errors['lastname'] = 'Veuillez renseigner votre nom';
        } else if (!preg_match($regexNames, $lastname)) {
            $errors['lastname'] = 'La valeur renseignée ne correspond pas au format attendu';
        }
        array_push($post,$lastname);
    
        // validation du firstname
    
        $firstname = trim(filter_input(INPUT_POST, 'firstname', FILTER_SANITIZE_STRING));
        // vérifier la validité de la valeur
        if (empty($firstname)) {
            $errors['firstname'] = 'Veuillez renseigner votre prenom';
        } else if (!preg_match($regexNames, $firstname)) {
            $errors['firstname'] = 'La valeur renseignée ne correspond pas au format attendu';
        }
        array_push($post,$firstname);
    
        $pseudo = trim(filter_input(INPUT_POST, 'pseudo', FILTER_SANITIZE_STRING));
        // vérifier la validité de la valeur
        if (empty($pseudo)) {
            $errors['pseudo'] = 'Veuillez renseigner votre pseudo';
         }/* else if (!preg_match($regexPseudo, $pseudo)) {
            $errors['pseudo'] = 'La valeur renseignée ne correspond pas au format attendu';
        } */
        $users = new Users('','','','','',$pseudo);
        $usersPseudo = $users->readPregMatchPseudo();
        
        foreach ($usersPseudo as $pseudo2) {
            $pseudoExist = $pseudo2->pseudo;
        }

        $users = new Users($users_id);
        $usersView = $users->readSingle();

        switch ($pseudo) {
            case $usersView->pseudo:
                $pseudo = $_POST['pseudo'];
                break;
             case $pseudoExist:
                $errors['pseudo'] = 'Votre pseudo existe déja';
                break; 
             default:
                $pseudo = $_POST['pseudo'];
        }
        array_push($post,$pseudo);
    
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
            
        // validation du firstname
    
        $email = trim(filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL));
        // vérifier la validité de la valeur
        if (empty($email)) {
            $errors['email'] = 'Veuillez renseigner votre email';
        }
        //Vérification de l'email pour qu'il n'y est pas 2 emails similaire
        $users = new Users('','','','',$email);
        $usersMail = $users->readPregMatchMail();
        
        foreach ($usersMail as $email2) {
            $emailExist = $email2->email;
        }

        $users = new Users($users_id);
        $usersView = $users->readSingle();
        //Conditions différentes selon la situation,il est correspond il valide et sort du traitement
        switch ($email) {
            case $usersView->email:
                $email = $_POST['email'];
                break;
             case $emailExist:
                $errors['email'] = 'Votre email existe déja';
                break; 
             default:
                $email = $_POST['email'];
        }

        array_push($post,$email);

        if(!empty($users_id)){
            // Si On reçoit une photo
            if($_FILES['picture']['error'] == 0){

                $filename = $_FILES['picture']['name'];
                // var_dump($_FILES);
                $extension = getExtension($filename);

                $sizePicture = $_FILES['picture']['size'];
                // Si poids pas ok
                if($sizePicture>MAXFILESIZE){
                    // Erreur de poids*
                    $errors["picture"] = "Erreur de poids";
                }
                // var_dump($sizePicture);
                // Si extension pas ok
                if(!in_array($extension, AUTHORIZED_EXTENSIONS)){
                    // Erreur d'extension
                    $errors["picture"] = "Erreur d'extension";
                }
                // var_dump($extension);
                // var_dump($users);
                // Si poids et extension ok
                if(count($errors) == 0){
                    // Definir le nom de la photo (pict-1.jpg, pict-4.png)
                    $pictureRenamed = "pict-".$users_id.".".$extension;
                    $pictureDest = dirname(__FILE__)."/..".PICT_FOLDER.$pictureRenamed;
                    
                    $tmp_name = $_FILES["picture"]["tmp_name"];
                    // Enregistrement de la photo
                    if(move_uploaded_file($tmp_name, $pictureDest)){
                        // Redimensionnement et compression
                        if(redim($pictureDest)){
                            $users->users_id = $users_id;
                            $users->photo = $extension;
                            // var_dump($users);
                            // $users->updateUser();
                        } else {
                            $errors["picture"] = "Un problème s'est produit lors du redimensionnement";
                        }
                    } else{
                        $errors["picture"] = "Un problème s'est produit lors de l'envoi de votre photo";
                    }
                }
            } else {
                // $errors["picture"] = "Vous êtes inscrit, mais vous n'avez pas envoyé de photo";
            }
        } else {
            $errors["picture"] = "Problème lors de l'enregitrement de votre pseudo";
        }


    }
//Validation si il n'y a pas derreur
if ($isSubmitted && count($errors) == 0){
    $users = new Users($users_id);
    $users->lastname = $lastname;
    $users->firstname = $firstname;
    $users->email = $email;
    $users->birthdate = $birthdate;
    $users->pseudo = $pseudo;
    $users->civility = $civility;
    $users->photo = $extension;
    $users->department_id = $departmentNumber;
    /* $users->department_id = $department; */
    
    //Modifie les informations 
    if ($users->update()) {
        $updateSuccess = true;
            header('refresh:2; users_ctrl.php?users_id='.$_SESSION['user']['users_id']);    
    }
}else{
    $updateNOTSuccess = true;
}

require_once dirname(__FILE__).'/../Controller/header_ctrl.php';
require_once dirname(__FILE__).'/../Controller/navbar_ctrl.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/modifyUsers.php';
