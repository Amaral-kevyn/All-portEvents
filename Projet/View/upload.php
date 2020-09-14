<form id='tof' action="" method="post" enctype="multipart/form-data">
    <label for="picture">Téléchager une image de profile</label>
    <input type="file" name="picture" id="picture">
    <p>formats acceptés (jpg, jpeg, png, gif), taille max 2M</p>
    <p class="text-danger"><?=$error?></p>
    <input type="submit" value="Envoyer">
</form>

<?php
include 'footer.php';