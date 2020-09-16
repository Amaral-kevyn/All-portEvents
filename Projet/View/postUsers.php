<main>
        <?php if (isset($updateSuccess)): ?>
            <div class="alert alert-success h2 text-center mt-3 mb-3" role="alert">
         <p>Votre commentaire a été ajouter avec succes !!!</p>
            </div>
        <?php endif; ?>

        <div class="contenair-fluid">
            <div class="row justify-content-center">
                <div class="col-12 col-md-6">
                    <div class="col-12 text-center">
                        <h2 class="card-text jaune montserrat noirBackground">Profil de : <span class='text-white'><?= $usersPostInfo->pseudo; ?></span></h2>
                    </div>

                    <div class="col-12 text-center mt-3">
                        <?php if (isset($_GET['users_id']) && ($usersPostInfo->photo != '')) : ?>
                         <img class="img-fluid p-2 w-25" style="border-radius:50%;" src="<?= PICT_FOLDER.'pict-'.$usersPostInfo->users_id.'.'.$usersPostInfo->photo; ?>" alt="profile picture">
                        <?php else: ?>
                         <img class="img-fluid p-2 w-25" style="border-radius:50%;" src="../assets/img/avatar.jpg" alt="Avatar par default">
                        <?php endif; ?>
                    </div>

                    <div class="col-12 text-center mt-3">   
                        <form action="" method='POST'>
                        <div class="col-12 text-center mt-4">
                            <label for="contentPost text-white montserrat"><span class='text-white montserrat h5 border-bottom'>Votre commentaire pour <?= $usersPostInfo->pseudo; ?> : </span></label>
                        </div>
                            <textarea class='rounded mt-3' id="contentPost" name="contentPost" rows="5" cols="50">  
                            </textarea>
                        <div class="col-12 text-center mt-3 mb-3">
                            <button class='btn btn-outline-warning w-25' name='ajouter'>Ajouter</button>
                        </div>
                        </form>
                    </div>
                </div>

                <div class="col-12 col-md-6 text-center mb-4 mt-4 text-white">

                        <?php if (count($usersPost ) > 0) { 
                        foreach ($usersPost as $user) { ?>
                    <div class="toast fade show ml-auto mr-auto mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                        <div class="toast-header bg-dark">
                            <strong class="mr-auto text-warning montserrat"><?= $user->sentNamePost?> </strong>
                            <small class='text-white'><?= $user->dateOfPost ?></small>

                            <?php if ($_SESSION['user']['admin'] == $moderateur || $_SESSION['user']['admin'] == $admin){ ?>
                            <a href='../Controller/deletePost_ctrl.php?post_id=<?= $user->post_id; ?>&users_id=<?= $user->users_id; ?>' class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span aria-hidden="true">×</span>
                            </a>
                           <?php } ?>

                        </div>
                        <div class="toast-body bg-white montserrat" style='color:black;'><?= $user->contentPost ?>
                    </div>
                </div>
                        <?php  }} else{ ?>
                            <h3 class='text-white montserrat text-center' style='margin:auto'>Aucun Commentaire pour le moment</h3>
                        <?php  } ?>
                </div>
            </div>
        </div>
    </main>


<?php
include 'footer.php';
?>