<div class="row justify-content-center mt-4 mb-4 pt-4 pb-4">

    <?php if (isset($createListEventsSuccess)): ?>
        <div class="col-12" role="alert">
            <p>Vous avez bien été enregistré pour participer à l'événement</p>
        </div>
    <?php else : ?>
        <h2 class="text-center text-success">Etes vous sûr de vouloir participer à l'événement ?</h2>
    <?php endif; ?>

    <form action="participate_ctrl.php" method="POST">
            <input type="hidden" name="events_id" value="<?= $events_id; ?>">
            <input type="hidden" name="users_id" value="<?= $users_id; ?>">
            <a class='text-white ml-3 btn btn-danger' href="javascript:history.back()">Annuler</a>
            <button type="submit" class="btn btn-success ml-2">Participer</button>
    </form>
</div>
