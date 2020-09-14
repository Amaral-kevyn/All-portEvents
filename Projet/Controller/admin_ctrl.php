<?php
	session_start();
	$title = 'Dashboard';


	if (!isset($_SESSION['user'])) {
		// redirection si pas connecté
		header('location: ../Inscription/Connexion');
		// stop la lecture du script
		exit();
    }
require_once dirname(__file__).'/../View/header_ctrl.php';
require_once dirname(__FILE__).'/../View/navbar.php';
require_once dirname(__FILE__).'/../View/navbarBottom.php';
require_once dirname(__FILE__).'/../View/admin.php';
?>

