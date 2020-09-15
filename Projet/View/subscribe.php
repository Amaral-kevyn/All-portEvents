<?php 
if(isset($userCreated)):?>
<div class="alert alert-success success h1 text-center mt-3 mb-3" role="alert">
    <p>Votre compte a été créé avec succès !!!</p>
</div>
<!-- <div class="alert alert-success text-center" role alert>
    Votre compte a été créé avec succès <i class="far fa-grin-alt"></i>!!!
</div> -->
<?php endif;
     if ($isSubmitted && count($errors) > 0): ?>
<div class="alert alert-danger rouge h1 text-center mt-3 mb-3" role="alert">
    <p>Inscription Invalide ,Veuillez vérifier le formulaire ! </p>
</div>
<?php endif; ?>

<div id='inscriptionID' class="container-fluid conuser">
    <div class="col-md-10 m-auto">
        <form class='formIn m-auto' method="post" action="">
            <div class="row text-center justify-content-center mt-1 text-white">
                <div class="col-12 text-white p-3 mt-5 mb-5">
                    <legend class='mb-5 mt-3 h1 montserrat' style='border-bottom: 1rem groove;'>Inscription</legend>
                    <div class="form-group">
                        <label for="civility" class='montserrat'>Civilité</label>
                        <select name="civility"
                            class="form-control w-75 m-auto  <?=$isSubmitted && isset($errors['civility']) ? 'is-invalid' : ''?>" id="
                        civility">
                            <option>Sélectionner votre civilité :</option>
                            <option <?=$civility == 1 ? 'selected' : ''?> value="1">Monsieur</option>
                            <option <?=$civility == 2 ? 'selected' : ''?> value="2">Madame</option>
                        </select>
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto"><?=$errors['civility'] ?? ""?></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label montserrat" for="lastname">Nom :</label>
                        <input class="form-control w-75 m-auto <?=$isSubmitted && isset($errors['lastname']) ? 'is-invalid' : ''?>"
                            value="<?=$lastname?>" id="lastname" name="lastname" type="text" placeholder="Lauper">
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto"><?=$errors['lastname'] ?? ""?></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label montserrat" for="firstname">Prénom :</label>
                        <input class="form-control w-75 m-auto <?=$isSubmitted && isset($errors['firstname']) ? 'is-invalid' : ''?>"
                            value="<?=$firstname?>" id="firstname" type="text" name="firstname" placeholder="Dave">
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto"><?=$errors['firstname'] ?? ""?></div>
                    </div>
                    <div class="form-group">
                        <label class="control-label montserrat" for="birthdate">Date de naissance :</label>
                        <input class="form-control w-75 m-auto  <?=$isSubmitted && isset($errors['birthdate']) ? 'is-invalid' : ''?>"
                            value="<?=$birthdate?>" id="birthdate" type="date" name="birthdate" placeholder="Dave">
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto"><?=$errors['birthdate'] ?? ""?></div>
                    </div>
                    <div class="form-group has-success">
                        <label class="form-control-label montserrat" for="zipCode">Code Postale :</label>
                        <input type="text" value="<?=$zipCode?>" name="zipCode"
                            class="form-control w-75 m-auto  <?=$isSubmitted && isset($errors['zipCode']) ? 'is-invalid' : ''?>"
                            id=" zipCode" placeholder='ak.manon@gmail.com'>
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto"><?=$errors['zipCode'] ?? ""?></div>
                    </div>
                    <div class="form-group has-success">
                        <label class="form-control-label montserrat" for="email">Email :</label>
                        <input type="email" value="<?=$email?>" name="email"
                            class="form-control w-75 m-auto  <?=$isSubmitted && isset($errors['email']) ? 'is-invalid' : ''?>"
                            id=" email" placeholder='ak.manon@gmail.com'>
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto"><?=$errors['email'] ?? ""?></div>
                    </div>
                    <div class="form-group mt-3 text-white">
                        <label class="control-label montserrat" for="pseudo">Pseudo :</label>
                        <input class="form-control w-75 m-auto  <?=$isSubmitted && isset($errors['pseudo']) ? 'is-invalid' : ''?>"
                            value="<?=$pseudo?>" id="pseudo" name="pseudo" type="text" placeholder="Dave3452">
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto"><?=$errors['pseudo'] ?? ""?></div>
                    </div>

                    <div class="form-group has-danger">
                        <label class="form-control-label montserrat" for="password">Mot de passe :</label>
                        <input type="password" value="<?=$password?>"
                            class="form-control w-75 m-auto  <?=$isSubmitted && isset($errors['password']) ? 'is-invalid' : ''?>"
                            name="password" id="password">
                            
                            <div id="forcePassword">
								<div class="force-progress w-100 rounded-pill">
  								<div id="progress" class="p-bar" role="progressbar" aria-valuemin="0" aria-valuemax="4"></div>
								</div>
								<div id="force" class="small text-white">faible</div>
							</div>
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto"><?=$errors['password'] ?? ""?></div>
                    </div>

                    <div class="form-group has-danger">
                        <label class="form-control-label montserrat" for="verifPassword">Verification Mot de passe :</label>
                        <input type="password" value="<?=$verifPassword?>"
                            class="form-control w-75 m-auto  <?=$isSubmitted && isset($errors['verifPassword']) ? 'is-invalid' : ''?>"
                            name="verifPassword" id="verifPassword">
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto"><?=$errors['verifPassword'] ?? ""?></div>
                    </div>
                    <div class="row  justify-content-around">
                <div class="form-check">
                    <input class="form-check-input" name="cgu" type="checkbox" value="cgu" id="cgu">
                    <label class="form-check-label font-weight-bold w-75 m-auto " for="cgu">
                        En soumettant ce formulaire, j'autorise que les informations saisies dans ce formulaire soient
                        utilisées pour permettre de me reconnecter ultérieurement.
                    </label>
                    <p class="error text-white bg-danger w-50 m-auto mb-5"><?= $errors['cgu'] ?? '' ?></p>
                </div>
            </div>
                    <div class="text-center"> <button type="submit" class="btn btn-warning " name='inscription'>Envoyer!</button></div>
                </div>
        </form>
</div>

</div>
</div>


<script src="assets/libs/js/jquery-3.4.1.min.js"></script>
    <script src="assets/libs/js/bootstrap.bundle.min.js"></script>
    <script src="assets/libs/js/jquery.js"></script>
    
<script src="assets/js/script.js"></script>

<script type='text/javascript'>
    

		/* $("input[name='password']").focus(function(){
			$("#forcePassword").slideDown();
		}) */

		// selectionne un élément et affique la fonction au keyup
		$("input[name='password']").keyup(function () {
            // prend la value du selecteur choisi prÃ©cÃ©dement
            var password = $(this).val();
            var force = 0;

            // vÃ©rifie que la regex est true ou false
            // var regex = (/(?=.*[a-z])/).test(password);

            // vÃ©rifie que la value de l'input contient des lettres
            // Si c'est le cas, la force prend +1
            if (password.match(/(?=.*[a-z])/) || password.match(/(?=.*[A-Z])/)) {
                force++;
            }

            // vÃ©rifie que la value de l'input contient des chiffres
            if (password.match(/(?=.*[0-9])/)) {
                force++;
            }

            // vÃ©rifie que la value de l'input contient des caractÃ¨res spÃ©ciaux
            if (password.match(/(?=.*\W)/)) {
                force++;
            }


            // vÃ©rifie que le password contient au moins 8 caractÃ¨res
            if (password.length >= 8) {
                force++;
            }

            // couleur en fonction de la force
            var textForce = $("#force");
            // couleur et texte en fonction de la force
            if (force == 1) {
                var bgColor = '#dc3545';
                textForce.text('Faible');
            } else {
                if (force == 2) {
                    var bgColor = '#ffc107';
                    textForce.text('Moyen');
                } else {
                    if (force == 3) {
                        var bgColor = '#28a745';
                        textForce.text('Fort');
                    } else {
                        if (force == 4) {
                            var bgColor = '#0d6e25';
                            textForce.text('Très fort');
                        }
                    }
                }
            }
            document.getElementById('progress').style.backgroundColor = bgColor;
            document.getElementById('progress').style.width = 25 * force + '%';

            //document.getElementById('progress').setAttribute('style', 'width:'+25*force+'%; background-color: '+bgColor);

            // change le css de la progressbar
            /*  $("#progress").css({
            	'width': 25*force+'%',
            	'background-color': bgColor
            });  */
        })
        // fait disparaitre la progressbar quand on quitte le champ password
        $("input[name='password']").blur(function () {
            $("#forcePassword").slideUp();
        })
        // Fait apparaitre la progressbar quand on focus le champ password
        document.querySelector(`input[name="password"]`).addEventListener('focus', function () {
            let forcePassword = $("#forcePassword").slideDown();
        })

        /* $("input[name='password']").focus(function(){
        	$("#forcePassword").slideDown();
        }) */
</script>
</body>

</html>