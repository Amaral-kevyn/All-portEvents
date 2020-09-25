<div class="row justify-content-center mt-4 mb-4 pt-4 pb-4">

    <?php if (isset($deletePostsSuccess)): ?>
        <div class="col-12" role="alert">
            <p>Le commentaire a été supprimé avec succès ! :)</p>
        </div>
    <?php else : ?>

        <div class="col-12">
            <h2 class="text-center text-danger">Etes vous sûr de vouloir supprimer le commentaire de <span class='text-white'> <?= $fullName; ?></span> ?</h2>
        </div>

        <div class="col-12 text-center mb-4 mt-3">
            <h3 class='text-white mb-3'>Contenu du post :</h3>
            <p class='text-warning text-center border border-white m-auto w-50'> <?= $postInfos->contentPost; ?></p>
        </div>
    <?php endif; ?>

    <form action="deletePost_ctrl.php" method="POST">
        <input type="hidden" name="fullName" value="<?= $fullName; ?>">
        <input type="hidden" name="post_id" value="<?= $post_id; ?>">
        <input type="hidden" name="users_id" value="<?= $users_id; ?>">
        <a class="btn btn-success ml-4 mr-2" href="listUsers_ctrl.php?users_id='<?= $_SESSION['user']['users_id']?>">Annuler</a>
        <button class="btn btn-danger" type="submit">Supprimer</button>
    </form>
</div>
</div>