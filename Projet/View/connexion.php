<div id='FormInsCon' class="row text-center">
        <div class="col-md-6 text-center">
        <div class="col-12 text-center mt-5">
        <a href='../Inscription/Connexion#connexionID' class="connected placementConnected h1 text-white">Se Connecter</a>
            </div>
            <div id='connexionID' class="col imgProfile d-none text-center mb-3 mt-5 text-white">
                <img class="img-fluid rounded mt-5" width='200em' src="../assets/img/<?=$photo?>" alt="<?=$photo?>">
                <p><a class="btn btn-outline-primary mt-4" href="../Controller/upload_ctrl.php#tof">Télécharger une image de profil</a>
                    </p>
                <form class='formConnexion d-none' method='POST' action='../Inscription/Connexion'>
                <div class="form-group mt-3 text-white">
                        <label class="control-label" for="login1">Pseudo</label>
                        <input class="form-control <?= $login1 ? 'is-invalid' : ''?>"
                            value="<?=$login1?>" id="login1" name="login1" type="text" placeholder="Dave3452">
                        <div class="invalid-feedback"><?=$errors['login1'] ?? ""?></div>
                    </div>
                    <div class="form-group text-white mb-5">
                        <label class="control-label" for="passwordLogin">Mot de passe</label>
                        <input
                            class="form-control <?=$isSubmitted && isset($errors['passwordLogin']) ? 'is-invalid' : ''?>"
                            value="<?=$passwordLogin?>" id="passwordLogin" type="password" name="passwordLogin"
                            placeholder="mot de passe">
                        <div class="invalid-feedback"><?=$errors['passwordLogin'] ?? ""?></div>
                        <div class="text-center mt-4"> <button type="submit" class="btn btn-danger " name='connexion'>Se
                                connecter</button>
                                </div>
                </form>
            </div>
        </div>
    </div>