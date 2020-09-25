<div class="row justify-content-center mt-4 mb-4 pt-4 pb-4">

    <?php if (isset($deleteUsersSuccess)): ?>
        <div class="col-12" role="alert">
            <p>L'utilisateur a été supprimé avec succès ! :)</p>
        </div>
    <?php else : ?>
        <h2 class="text-center text-danger">Etes vous sûr de vouloir supprimer l'utilisateur <?= $fullName; ?> ?</h2>
    <?php endif; ?>

    <form action="userAdminDelete_ctrl.php" method="POST">
            <input type="hidden" name="fullName" value="<?= $fullName; ?>">
            <input type="hidden" name="users_id" value="<?= $users_id; ?>">
            <a class="btn btn-success ml-4 mr-2" href="listUsers_ctrl.php">Annuler</a>
            <button class="btn btn-danger" type="submit">Supprimer</button>
    </form>
</div>