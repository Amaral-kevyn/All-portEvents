<?php
$error = '';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
// image téléchargé sans erreur
    if (isset($_FILES['picture']) && $_FILES['picture']['error'] == 0) {
        $allowedextension = ['jpg', 'jpeg', 'png', 'gif'];
        $maxsize = 1024 * 1024 * 1;
        $filename = $_FILES['picture']['name'];
        $filesize = $_FILES['picture']['size'];
        $tmp = $_FILES['picture']['tmp_name'];
        $fileextension = pathinfo($_FILES['picture']['name'], PATHINFO_EXTENSION);
        // Vérification de l'extension
        if (!in_array($fileextension, $allowedextension)) {
            $error = 'Le format du fichier téléchargé n\'est pas autorisé !';
        } elseif ($maxsize < $filesize) {
            $error = 'Le fichier téléchargé depasse la taille max autorisée !';
        }

        if (empty($error)) {
            if (move_uploaded_file($tmp, '../assets/img' . $filename)) {
                setcookie('picture', $filename, time() + 3600);
                header('Location: ../Inscription/Connexion#FormInsCon');
                /* header('Location: inscription.php?picture=' . $filename); */
                exit();
            }
        }

    }
}
require_once dirname(__FILE__).'/../Controllers/header_ctrl.php';
require_once dirname(__FILE__).'/../View/navbar.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/upload.php';