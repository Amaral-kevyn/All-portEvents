
 require_once dirname(__FILE__) . '/../Models/user.php';
require_once dirname(__FILE__) . '/../Config/config.php';
require_once dirname(__FILE__) . '/../Utils/fonctions.php';

 if (isset($_SESSION['user']['users_id'])){
    $users_id = (int) $_SESSION['user']['users_id'];
     $usersInfos = new Users($users_id); 
    $usersViews = $usersInfos->readSingle();
    $photo = PICT_FOLDER.'pict-'.$usersViews->users_id.'.'.$usersViews->photo;
} 

navbar_ctrl


<?php
        if (isset($_SESSION['user']['users_id']) && ($usersViews->photo != '')): ?>
          <img class="img-fluid" style="border-radius:50%;" width='50em' src="<?= $photo ?>" alt="profile picture">
        <?php else: ?>
            <img class="img-fluid" style="border-radius:50%;" width='50em' src="../assets/img/avatar.jpg" alt="Avatar par default">
        <?php endif; ?>
                    <label class="text-secondary" for="picture">Photo de Profil :</label>
                    <input class="form-control" type="file" id="picture" name="picture">
                    <!-- ========== input hidden=============================================== -->
                    <input type="hidden" name="picture" value="<?=$usersViews->photo?>">
                    <!-- ========== input hidden=============================================== -->
                    <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto"><?= $errors['picture'] ?? '' ?></div>
            </div> 



navbar view 
endessou imgProfil et session_abort
<?php
if (isset($_SESSION['user']['users_id']) && ($usersViews->photo != '')): ?>
  <img class="img-fluid ml-2" style="border-radius:50%;"  src="<?= $photo ?>" alt="profile picture">
<?php else: ?>
    <img class="img-fluid ml-2" style="border-radius:50%;" width='2em' src="../assets/img/avatar.jpg" alt="Avatar par default">
<?php endif; 

modify iput hidden

<input type="hidden" name="picture" value="<?=$usersViews->photo?>">