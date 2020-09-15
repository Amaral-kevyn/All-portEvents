<div class="container-fluid">
	<div class="row justify-content-center">
<div id='userPlace' class="cardUser col-12 mt-4 mb-4 ">
                <div class="card-body bg-light text-center border rounded border-info noirBackground m-auto" style='width:22em;'>
                    <img class="card-img-top p-2 w-50" src="../assets/img/avatar.jpg" style='border-radius:50%; width:2em;'
						alt="Card image cap">
						
                    <p class="card-text jaune montserrat noirBackground">Utilisateur n° : <span class='text-white'>
                            <?= $usersView->users_id; ?></span></p>
                    <p class="card-text orange montserrat noirBackground">Date de création du compte : <span class='text-white'>
                            <?= $usersView->dateOfCreation; ?></span></p>
                    <p class="card-text orange montserrat noirBackground">Genre : <span class='text-white'>
							<?php 
							if($usersView->civility == '1'){
								echo 'Monsieur';
							}else{
								echo 'Madame';
							}?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Pseudo : <span class='text-white'>
                            <?= $usersView->pseudo; ?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Nom : <span class='text-white'>
                            <?= $usersView->lastname; ?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Prénom : <span class='text-white'>
					<?= $usersView->firstname;?> </span>
                    </p>
                    <p class="card-text orange montserrat noirBackground ">Date de Naissance : <span class='text-white'>
                            <?= $usersView->birthdate_format; ?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Code Postal : <span class='text-white'>
                            <?= $usersView->zipCode; ?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Email : <span class='text-white'> 
						<?= $usersView->email; ?></span>
                    </p>
                    <p class="card-text orange montserrat noirBackground ">Role : <span class='text-white'> 
						<?php
						if($usersView->admin_id == '65498'){
								echo 'Utilisateur';
						}elseif ($usersView->admin_id == '83714') {
								echo 'Admin';
						}else {
								echo 'Modérateur';
						} ?></span>
                    </p>

                    <a class="btn btn-warning montserrat text-white col-12 mb-2"
                        href="../Controller/modifyUsers_ctrl.php?users_id=<?= $_SESSION['user']['users_id']; ?>">Modifier
                        mon profil</a>
                   
				</div>
				</div>
</div>

<?php
	include 'footer.php';
?>