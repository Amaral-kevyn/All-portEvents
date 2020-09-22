<main class='container-fluid'>
<div class="row m-auto">
<div class="col-12 text-center mb-5 mt-5 text-white">
        <h2 class='mb-5 montserrat border-bottom'>Liste commentaire utilisateur </h2>
        <?php if (count($usersPostModerateur ) > 0) { 
                        foreach ($usersPostModerateur as $user) { ?>
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