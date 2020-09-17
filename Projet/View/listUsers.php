<main class="container-fluid  ml-1 mr-1">
        <div class="row justify-content-around">
            <?php if (count($usersList) > 0) { 
                foreach ($usersList as $number => $user) { ?>

            <div id='userListPlace' class="card-user-list col-6 col-sm-6 col-md-3 mt-4 mb-4">
                <div class="card-body bg-light text-center border rounded border-info">

                <?php
        if (isset($_SESSION['user']) && ($user->photo != '')): ?>
          <img class="img-fluid w-50 mb-3" style="border-radius:50%;" src="<?= PICT_FOLDER.'pict-'.$user->users_id.'.'.$user->photo; ?>" alt="profile picture">
        <?php else: ?>
            <img class="img-fluid w-50 mb-3" style="border-radius:50%;" src="../assets/img/avatar.jpg" alt="Avatar par default">
        <?php endif; ?>
        
                    <p class="card-text jaune montserrat noirBackground">Utilisateur n° : <span class='text-white'>
                            <?= $number + 1; ?></span></p>
                            <p class="card-text orange montserrat noirBackground">Genre : <span class='text-white'>
							<?php 
							if($user->civility == '1'){
								echo 'Monsieur';
							}else{
								echo 'Madame';
							}?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Pseudo : <span class='text-white text-capitalize'>
                            <?= $user->pseudo; ?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Age : <span class='text-white'>
                            <?= $user->age; ?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Code Postal :<span class='text-white'>
                            <?= $user->zipCode; ?></span></p>

                        <?php if ($_SESSION['user']['admin'] == $admin){ ?>
                    <p class="card-text orange montserrat noirBackground ">Nom : <span class='text-white text-capitalize'>
                            <?= $user->lastname; ?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Prénom : <span class='text-white'>
                            <?= $user->firstname; ?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Role : <span class='text-white'>
                    <?php
						if($user->admin_id == $utilisateur){
								echo 'Utilisateur';
						}elseif ($user->admin_id == $admin) {
								echo 'Admin';
						}else {
								echo 'Modérateur';
						} ?></span></p>

                    <a class="btn btn-danger text-white col-12 mb-2"
                        href="../Controller/deleteAdmin_ctrl.php?users_id=<?= $user->users_id; ?>">Supprimer
                        l'utilisateur</a>
                        <?php } ?>
                            <a class="btn btn-success text-white col-12 mb-2"
                        href="../Controller/postUsers_ctrl.php?users_id=<?= $user->users_id; ?>">Voir Commentaires</a>
                </div>
            </div>
            <?php } ?>
            <?php } else { ?>
            <h4 class="text-center">Aucun utilisateurs n'as été trouvé.
            </h4>
            <?php } ?>

        </div>
    </main>

<?php
	include 'footer.php';
?>