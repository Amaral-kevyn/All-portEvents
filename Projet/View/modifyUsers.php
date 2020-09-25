<div class="container-fluid">
    <div class="row justify-content-center">

        <?php if (isset($updateSuccess)): ?>
        <div class="alert alert-success h2 text-center mt-3 mb-3" role="alert">
            <p>Votre profil a été modifié avec succès <i class="far fa-grin-alt"></i>!!!</p>
        </div>
        <?php endif; ?>

        <?php if ($isSubmitted && count($errors) > 0 ): ?>
        <div class="alert rougeBackground h2 text-center mt-3 mb-3 text-white" role="alert">
            <p>Modification incorrect , veuillez vérifiez les informations saisies !!!</p>
            <p>Erreur : / <?= $errors['pseudo'] ?? '' ?> / <?= $errors['picture'] ?? '' ?> / <?= $errors['email'] ?? '' ?> / <?= $errors['lastname'] ?? '' ?> / <?= $errors['firstname'] ?? '' ?> / <?= $errors['zipCode'] ?? '' ?> / </p>
        </div>
        <?php endif; ?>

        <form action="modifyUsers_ctrl.php" method="Post" class="border col-10 col-md-8 rounded text-center"
            enctype="multipart/form-data">
            <div class="col-md-10 m-auto justify-content-center">


                <legend class='text-dark bg-warning mb-4'>Modifier mon profil</legend>
                <div class="row justify-content-center">
                    <div class='text-center mt-5'>
                        <figure class="rounded-circle">
                            <?php if (isset($_SESSION['user']['users_id']) && $photo != NULL): ?>
                            <img src="<?= $photo ?>" alt="profile picture" class="w-100 img-fluid">
                            <?php else: ?>
                            <img src="/assets/img/avatar.jpg" alt="" class="w-100 img-fluid">
                            <?php endif; ?>
                            <figcaption>
                                <label for="picture" title="Changer ma photo">
                                    <input type="file" name="picture" id="picture" class="d-none"
                                        value="<?= $usersInfos->photo ?>">
                                    <input type="hidden" name="picture" value="<?= $usersInfos->photo ?>">
                                    <i class="fas fa-camera mt-2"></i>
                                </label>
                            </figcaption>
                        </figure>
                    </div>
                </div>

                <div>
                    <label for="civility" class='montserrat text-white'>Civilité</label>
                    <select name="civility"
                        class="form-control m-auto  <?=$isSubmitted && isset($errors['civility']) ? 'is-invalid' : ''?>"
                        id=" civility">
                        <option value='<?= $usersInfos->civility ?>'>Votre choix actuel : <?php if($usersInfos->civility == 1){
                                echo 'Monsieur';
                            }else{
                                echo 'Madame';
                            }?>
                        </option>

                        <option <?=$civility == 1 ? 'selected' : ''?> value="1">Monsieur</option>
                        <option <?=$civility == 2 ? 'selected' : ''?> value="2">Madame</option>
                    </select>
                    <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto">
                        <?= $errors['civility'] ?? '' ?>
                    </div>

                    <div>
                        <label class='text-white' for="pseudo">Pseudo :</label>
                        <input class="form-control" type="text" name="pseudo" id="pseudo"
                            value="<?= $usersInfos->pseudo; ?>">
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto">
                            <?= $errors['pseudo'] ?? '' ?></div>
                    </div>
                    <div>
                        <label class='text-white' for="lastname">Nom :</label>
                        <input class="form-control" type="text" name="lastname" id="lastname"
                            value="<?= $usersInfos->lastname; ?>">
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto">
                            <?= $errors['lastname'] ?? '' ?></div>
                    </div>
                    <div>
                        <label class='text-white' for="firstname">Prenom :</label>
                        <input class="form-control" type="text" name="firstname" id="firstname"
                            value="<?= $usersInfos->firstname; ?>">
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto">
                            <?= $errors['firstname'] ?? '' ?></div>
                        <!--============== INPUT HIDDEN ====================== -->
                        <input type="hidden" name="users_id" value="<?= $usersInfos->users_id; ?>">
                        <!-- ================================================ -->
                    </div>
                    <div>
                        <label class='text-white' for="birthdate">Date de Naissance :</label>
                        <input class="form-control" type="date" name="birthdate" value="<?= $usersInfos->birthdate;?>">
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto">
                            <?= $errors['birthdate'] ?? '' ?></div>
                    </div>

                    <div>
                        <div>
                            <label for="departmentCode" class='montserrat'>Département : </label>
                            <input class="form-control" type="text" name="departmentCode"
                                id="departmentCode" value='<?= $usersInfos->departmentCode; ?>'>
                                
                        </div>
                        <div>
                            <label for="departmentName" class='montserrat mt-3'>Nom du département : </label>
                            <select name="departmentName" id="departmentName">
                            <option value="<?= $usersInfos->department_id; ?>"><?= $usersInfos->departmentName; ?></option>
                                <option value=""></option>
                            </select>
                        </div>
                    </div>

                    <div>
                        <label class='text-white' for="email">Email :</label>
                        <input class="form-control" type="email" id="email" name="email"
                            value="<?= $usersInfos->email; ?>">
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto">
                            <?= $errors['email'] ?? '' ?></div>
                    </div>


                    <input class="btn btn-warning mt-2" type="submit" name='Modifier' value="Modifier"
                        style='margin-bottom:4em;'>
                </div>
            </div>
        </form>
    </div>
</div>
<script src="../assets/libs/js/jquery-3.4.1.min.js"></script>
<script src="../assets/libs/js/bootstrap.bundle.min.js"></script>
<script src="../assets/libs/js/jquery.js"></script>
    
<script src="../assets/js/script.js"></script>
<script>
departmentNumber = document.getElementById("departmentCode");
departmentNumber.addEventListener("keyup", getDepartment);

function getDepartment(){
    let search = this.value;

    let monFormDepart = new FormData();
    monFormDepart.append("departmentCode",search);
    monFormDepart.append("ajaxDP",2);

    if(search.length>=2){
        //Appel Ajax pour récupérer un tableau de departement correspondant au code (search)
        let param = {
            method: 'POST',
            body: monFormDepart
        }
        fetch('modifyUsers_ctrl.php',param)
        .then(function(response) {
            return response.json();
        })
        .then(function(departmentAll) {
            let options = '';
            departmentAll.forEach(function(department){
                options += '<option value="'+department.department_id+'">'+department.departmentName+'</option>';
            })
            document.getElementById("departmentName").innerHTML = options;
        })
    }
}
</script>