<div class="container-fluid">
<div class="row justify-content-center">

<form action="modifyUsers_ctrl.php" method="Post" class="border col-6 rounded form text-center bg-light" enctype="multipart/form-data">
        <div class="col-md-10 m-auto justify-content-center">
           <?php if (isset($updateSuccess)): ?>
<div class="alert alert-success h2 text-center mt-3 mb-3" role="alert">
    <p>Votre profil a été modifié avec succès  <i class="far fa-grin-alt"></i>!!!</p>
</div>
<?php endif; ?>

            <legend class='text-dark bg-warning'>Modifier mon profil</legend>

            <figure class="rounded-circle">
                <?php if (isset($_SESSION['user']['users_id']) && ($usersViews->photo != NULL)): ?>
                <img src="<?= $photo ?>" alt="profile picture" class="w-100 img-fluid">
                <?php else: ?>
                    <img src="../assets/img/avatar.jpg" alt="" class="w-100 img-fluid">
                <?php endif; ?>
                <figcaption>
                    <label for="picture" title="Changer ma photo">
                        <input type="file" name="picture" id="picture" class="d-none" value="<?= $usersViews->photo ?>">
                        <input type="hidden" name="picture" value="<?= $usersViews->photo ?>">
                        <i class="fas fa-camera mt-2"></i>
                    </label>
                </figcaption>
            </figure>

            <div class="form-control">
                <label for="civility" class='montserrat'>Civilité</label>
                        <select name="civility"
                            class="form-control m-auto  <?=$isSubmitted && isset($errors['civility']) ? 'is-invalid' : ''?>" id=" civility">
                            <option value='<?= $usersInfos->civility ?>'>Votre choix actuel : <?php if($usersInfos->civility == 1){
                                echo 'Monsieur';
                            }else{
                                echo 'Madame';
                            }?> 
                            </option>

                            <option <?=$civility == 1 ? 'selected' : ''?> value="1">Monsieur</option>
                            <option <?=$civility == 2 ? 'selected' : ''?> value="2">Madame</option>
                        </select>
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto"><?= $errors['civility'] ?? '' ?>
                        </div>
    
            <div>
                <label class='text-secondary'  for="pseudo">Pseudo :</label>
                <input class="form-control" type="text" name="pseudo" id="pseudo" value="<?= $usersInfos->pseudo; ?>">
                <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto"><?= $errors['pseudo'] ?? '' ?></div>
            </div>
            <div>
                <label class='text-secondary'  for="lastname">Nom :</label>
                <input class="form-control" type="text" name="lastname" id="lastname" value="<?= $usersInfos->lastname; ?>">
                <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto"><?= $errors['lastname'] ?? '' ?></div>
            </div>
            <div >
                <label class='text-secondary' for="firstname">Prenom :</label>
                <input class="form-control" type="text" name="firstname" id="firstname" value="<?= $usersInfos->firstname; ?>">
                <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto"><?= $errors['firstname'] ?? '' ?></div>
                <!--============== INPUT HIDDEN ====================== -->
                <input type="hidden" name="users_id" value="<?= $usersInfos->users_id; ?>">
                <!-- ================================================ -->
            </div>
            <div>
                <label class='text-secondary'  for="birthdate">Date de Naissance :</label>
                <input class="form-control" type="date" name="birthdate" value="<?= $usersInfos->birthdate;?>">
                <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto"><?= $errors['birthdate'] ?? '' ?></div>
            </div>
            <div>
                <label class='text-secondary'  for="zipCode">ZipCode :</label>
                <input class="form-control" type="text" name="zipCode" value="<?= $usersInfos->zipCode;?>">
                <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto"><?= $errors['zipCode'] ?? '' ?></div>
            </div>
           
            <div>
                <label class='text-secondary'  for="email">Email :</label>
                <input class="form-control" type="email" id="email" name="email" value="<?= $usersInfos->email; ?>">
                <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto"><?= $errors['email'] ?? '' ?></div>
            </div>
           

            <input class="btn btn-warning mt-2" type="submit" name='Modifier' value="Modifier" style='margin-bottom:4em;'>
        </div>
    </form>
</div>
</div>