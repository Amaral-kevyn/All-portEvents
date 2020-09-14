<?php 
	$title = 'Cookie data user';

	if (isset($_COOKIE['user'])) {
		// reforme le tableau serialisé
        $user = unserialize($_COOKIE['user']);
?>
		<div class="container">
			<div class="w-100 p-3">
				<h1>Base de donnée</h1>
				<div class="p-3 rounded border border-dark text-center">
					<?php
						// affiche tout le tableau
						foreach ($user as $key => $value) {
							// condition pour le genre
							if ($key == 'civility'){
								// Si le genre est 1 on affiche madame sinon c'est monsieur 
								$value = $value == 2 ? 'Madame' : 'Monsieur';
							}
							?> <p> <?= $value; ?> </p> <?php
						}
					?>
				</div>
			</div>
		</div>
	<?php
	}
	else{
?>
		<p class="text-danger">Aucun utilisateur n'est inscrit</p>
		<a class="btn btn-dark" href="inscription.php">Retour à l'accueil</a>
<?php
	}

	include 'footer.php';
?>