<main>
    <?php if (isset($updateSuccess)): ?>
    <div class="alert alert-success h2 text-center mt-3 mb-3" role="alert">
        <p>Votre commentaire a été ajouter avec succes !!!</p>
    </div>
    <?php endif; ?>

    <div class="contenair-fluid">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 mb-4 mt-2">
                <div class="col-12 text-center">
                    <h2 class="card-text jaune montserrat noirBackground mb-2">Liste utilisateur : </h2>
                </div>
                <?php if (count($eventsParticipate ) > 0) { 
                        foreach ($eventsParticipate as $participate) { ?>
                           <p class='vert mt-1 mb-1 text-center'><?= $participate->pseudo ?> <p> 
                    <?php }}else{ ?>
                    <h3 class='text-white'>Pas d'utilisateur pour le moment pour cette événement</h3>
                       <?php }?>
            </div>

            <div class="col-12 col-md-6 text-center mb-4 mt-2 text-white">

            <div class="col-12 text-center">
                    <form action="" method='POST'>
                        <div class="col-12 text-center">
                          <h2 class="card-text orange montserrat noirBackground">Commentaire événement : </h2>
                        </div>
                        <textarea class='rounded mt-3' id="contentPost" name="contentPost" rows="5" cols="50">
                            </textarea>
                        <div class="col-12 text-center mt-3 mb-3">
                            <button class='btn btn-outline-warning w-25' name='ajouter'>Ajouter</button>
                        </div>
                    </form>
                </div>

                <?php if (count($usersPostEvents ) > 0) { 
                        foreach ($usersPostEvents as $user) { ?>
                <div class="toast fade show ml-auto mr-auto mb-3" role="alert" aria-live="assertive" aria-atomic="true">
                    <div class="toast-header bg-dark">
                        <strong class="mr-auto text-warning montserrat"><?= $user->sentNamePost?> </strong>
                        <small class='text-white'><?= $user->dateOfPost ?></small>

                        <?php if ($_SESSION['user']['admin'] == $moderateur || $_SESSION['user']['admin'] == $admin){ ?>
                        <a href='../Controller/deletePost_ctrl.php?post_id=<?= $user->post_id; ?>&users_id=<?= $user->users_id; ?>'
                            class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close"><span
                                aria-hidden="true">×</span>
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