<div class="container-fluid">
        <div class="row justify-content-center">
                <div id='userPlace' class="cardUser col-12 mt-4 mb-4">
                        <div class="card-body bg-light text-center border rounded border-info noirBackground m-auto"
                                style='width:22em;'>

                                <?php if (isset($_SESSION['user']) && ($photo == '' || NULL )) : ?>
                                        <img class="card-img-top p-2 w-50" style="width:2em;border-radius:50%;"
                                        src="../assets/img/avatar.jpg" alt="Avatar par default">
                                <?php else: ?>
                                        <img class="card-img-top p-2 w-50" style="width:2em;border-radius:50%;"
                                        src="<?= $photo ?>" alt="profile picture">
                                <?php endif; ?>

                                <p class="card-text jaune montserrat noirBackground">Utilisateur n° : <span
                                                class='text-white'>
                                                <?= $usersView->users_id; ?></span></p>
                                <p class="card-text orange montserrat noirBackground">Date de création du compte : <span
                                                class='text-white'>
                                                <?= $usersView->dateOfCreation; ?></span></p>
                                <p class="card-text orange montserrat noirBackground">Genre : <span class='text-white'>
                                                <?php if($usersView->civility == '1'){
                                                        echo 'Monsieur';
                                                }else{
                                                        echo 'Madame';
                                                }?></span></p>

                                <p class="card-text orange montserrat noirBackground ">Pseudo : <span
                                                class='text-white text-capitalize'>
                                                <?= $usersView->pseudo; ?></span></p>
                                <p class="card-text orange montserrat noirBackground ">Nom : <span
                                                class='text-white text-capitalize'>
                                                <?= $usersView->lastname; ?></span></p>
                                <p class="card-text orange montserrat noirBackground ">Prénom : <span
                                                class='text-white text-capitalize'>
                                                <?= $usersView->firstname;?> </span>
                                </p>
                                <p class="card-text orange montserrat noirBackground ">Département d'habitation: <span
                                                class='text-white text-capitalize'>
                                                <?= $usersView->departmentName;?>  [ <?= $usersView->departmentCode;?> ]  </span>
                                </p>
                                <p class="card-text orange montserrat noirBackground ">Date de Naissance : <span
                                                class='text-white'>
                                                <?= $usersView->birthdate_format; ?></span></p>
                
                                <p class="card-text orange montserrat noirBackground ">Email : <span class='text-white'>
                                                <?= $usersView->email; ?></span>
                                </p>
                                <p class="card-text orange montserrat noirBackground ">Role : <span class='text-white'>
                                                <?php
						if($usersView->admin_id == $utilisateur){
								echo 'Utilisateur';
						}elseif ($usersView->admin_id == $admin) {
								echo 'Admin';
						}else {
								echo 'Modérateur';
						} ?></span>
                                </p>

                                <a class="btn btn-warning montserrat text-white col-12 mb-2"
                                        href="../Controller/modifyUsers_ctrl.php?users_id=<?= $_SESSION['user']['users_id']; ?>">Modifier
                                        mon profil</a>
                                <a href='../Controller/myParticipation_ctrl.php?users_id=<?= $_SESSION['user']['users_id']; ?>' class='btn btn-outline-info text-white mb-2'>Participation Evénement </a>
                                <a href='#' class='btn btn-outline-success text-white mb-2'>Evénement crée</a>

                        </div>
                </div>
        </div>
</div>

<?php
include 'footer.php';
