<div class='container-fluid conuser'>
<div class="row justify-content-center">
        <form class='formConnexion col-10 col-md-5 text-center mb-5 mt-4' method='POST' action=''>

            <legend id='loginPlacement' class='text-white Montserrat h2' style='border-bottom: 1rem groove;'>Connexion</legend>
                <div class=" w-100">
                    <img class="img-fluid rounded mt-5 text-center" width='200em' src="<?=$photo?> ?? 'avatar.jpg" alt="<?=$photo?>">

                <div class="form-group mt-3 text-white text-center">
                    <label class="control-label Montserrat" for="email">Email :</label>
                    <input class="form-control w-100 <?=$isSubmitted && isset($errors['email']) ? 'is-invalid' : ''?>" value="<?=$email?>" id="email" name="email" type="text" placeholder="Dave3452">
                        <div class="text-white bg-danger w-75 m-auto"><?=$errors['email'] ?? ""?>
                        </div>
                </div>

                <div class="form-group text-white text-center mb-5">
                    <label class="control-label Montserrat" for="password">Mot de passe :</label>
                    <input class="form-control w-100<?=$isSubmitted && isset($errors['password']) ? 'is-invalid' : ''?>" value="<?=$password?>" id="password" type="password" name="password" placeholder="mot de passe">
                        <div class="text-white bg-danger w-75 m-auto"><?=$errors['password'] ?? ""?>
                        </div>
                </div>
                        
                <div class="text-center mt-4"> <button type="submit" class="btn btn-danger " name='connexion'>Se connecter</button>
                </div>
                </div>
                
        </form>
        </div>
</div>

<?php
include 'footer.php';