<main class="container-fluid  ml-1 mr-1">
        <div class="row justify-content-around">
            <?php if (count($usersList) > 0) { 
                foreach ($usersList as $number => $user) { ?>

            <div id='userListPlace' class="card-user-list col-4 col-sm-4 col-md-3 mt-4 mb-4">
                <div class="card-body bg-light text-center border rounded border-info">
                    <img class="card-img-top p-2 w-75" src="../assets/img/avatar.jpg" style='border-radius:50%;'
                        alt="Card image cap">
                    <p class="card-text jaune montserrat noirBackground">Utilisateur n° : <span class='text-white'>
                            <?= $number + 1; ?></span></p>
                            <p class="card-text orange montserrat noirBackground">Genre : <span class='text-white'>
							<?php 
							if($user->civility == '1'){
								echo 'Monsieur';
							}else{
								echo 'Madame';
							}?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Pseudo : <span class='text-white'>
                            <?= $user->pseudo; ?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Date de Naissance : <span class='text-white'>
                            <?= $user->age; ?></span></p>
                    <p class="card-text orange montserrat noirBackground ">Code Postal : : <span class='text-white'>
                            <?= $user->zipCode; ?></span></p>
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