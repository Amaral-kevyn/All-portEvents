<main>
        <div class="contenair-fluid">
            <div class="row">
                <div class="col-12 col-12 col-md-6">

                <h2 class="card-text jaune montserrat noirBackground">Profil de : <span class='text-white'>
                            <?= $usersPostInfo->pseudo; ?></span></h2>

                <?php if (isset($_GET['users_id']) && ($usersPostInfo->photo != '')) : ?>
                         <img class="img-fluid p-2 w-50" style="width:2em;border-radius:50%;" src="<?= PICT_FOLDER.'pict-'.$usersPostInfo->users_id.'.'.$usersPostInfo->photo; ?>" alt="profile picture">
                <?php else: ?>
                         <img class="img-fluid p-2 w-50" style="width:2em;border-radius:50%;" src="../assets/img/avatar.jpg" alt="Avatar par default">
                <?php endif; ?>
                    
                    <form action="" method='POST'>
                    <label for="contentPost">Votre commentaire pour <?= $usersPostInfo->pseudo; ?> :</label>

                        <textarea id="contentPost" name="contentPost" rows="5" cols="33">
                            
                        </textarea>
                        <button class='btn btn-outline-warning' name='ajouter'>Ajouter</button>
                    </form>

                </div>

                <?php  
                foreach ($usersPost => $user) { ?>
                <div class="col-12 col-md-6 text-center my-5 text-white">

                <div class="toast fade show" role="alert" aria-live="assertive" aria-atomic="true">
                 <div class="toast-header">
                    <strong class="mr-auto"><?= $user->sentNamePost?> </strong>
                    <small><?= $user->dateOfPost ?></small>
                    <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="toast-body">
                <?= $user->contentPost ?>
                </div>
                </div>

            </div>
               <?php }else{ ?>
                <h3>Aucun Commentaire pour le moment</h3>
              <?php  } ?>

            </div>
        </div>
    </main>


<?php
include 'footer.php';
?>