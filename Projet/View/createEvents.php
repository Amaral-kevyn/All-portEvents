<?php if(isset($eventCreated )):?>
    <div class="alert alert-success success h1 text-center mt-3 mb-3" role="alert">
    <p>Votre évènement a été créé avec succès !!!</p>
    </div>
<?php endif;

if ($isSubmitted && count($errors) > 0): ?>
    <div class="alert alert-danger rouge h1 text-center mt-3 mb-3" role="alert">
    <p>Champs Invalide ,Veuillez vérifier le formulaire !<?= $errors['typeOfEvents'] ?? '' ?>// ,<?= $errors['dateOfEvents'] ?? '' ?> ,<?= $errors['budget'] ?? '' ?>, <?= $errors['location'] ?? '' ?>,
    <?= $errors['maxParticipant'] ?? '' ?>,<?= $errors['activityOfEvents_id'] ?? '' ?>,<?= $errors['difficulty'] ?? '' ?>,
    <?= $errors['contentEvent'] ?? '' ?>,<?= $errors['location'] ?? '' ?>,<?= $errors['location'] ?? '' ?>
</p>
    </div>
<?php endif; ?>

<div id='CreateEvent' class="container-fluid montain">
    <div class="col-md-10 m-auto">
        <form class='formEvent m-auto noirBackgroundEvents rounded' method="post" action="">
            <div class="row text-center justify-content-center mt-1 text-white">
                <div class="col-12 text-white p-3 mt-5 mb-5">
                    <legend class='mb-5 mt-3 h1 montserrat font-weight-bold' style='border-bottom: 1rem groove;'>Création d'un évènement
                    </legend>

                    <div class="form-group">
                        <label for="typeOfEvents" class='montserrat'>Type d'événement</label>
                        <select name="typeOfEvents" id='typeOfEvents'
                            class="form-control w-75 m-auto  <?=$isSubmitted && isset($errors['typeOfEvents']) ? 'is-invalid' : ''?>"
                            id="
                        typeOfEvents">
                            <?php foreach($resultsEvents as $event){ ?>
                            <option value="<?=$event->typeOfEvents_id?>"><?= $event->type?></option>
                            <?php } ?>

                        </select>
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto">
                            <?=$errors['typeOfEvents'] ?? ""?></div>
                    </div>

                    <div class='mb-3'>
                        <label for="activityOfEvents"class='montserrat'> Activité de l'évènement : </label>
                        <select name="activityOfEvents" id="activityOfEvents">
                            <div class="invalid-feedback bg-danger w-50 text-white m-auto">
                                <?=$errors['activityOfEvents'] ?? ""?></div>
                            <option value=""></option>
                        </select>
                    </div>


                    <div class="form-group">
                        <label for="budget" class='montserrat'>Budget</label>
                        <select name="budget"
                            class="form-control w-75 m-auto  <?=$isSubmitted && isset($errors['budget']) ? 'is-invalid' : ''?>"
                            id="
                        budget">
                            <option>Sélectionner le budget de l'évènement :</option>
                            <option <?=$budget == 1 ? 'selected' : ''?> value="1">Gratuit</option>
                            <option <?=$budget == 2 ? 'selected' : ''?> value="2">Prix compris entre 0 et 10 €</option>
                            <option <?=$budget == 3 ? 'selected' : ''?> value="3">Prix compris entre 10 et 20 €</option>
                            <option <?=$budget == 4 ? 'selected' : ''?> value="4">Prix compris entre 20 et 40 €</option>
                            <option <?=$budget == 5 ? 'selected' : ''?> value="5">Prix compris entre 40 et 50 €</option>
                            <option <?=$budget == 6 ? 'selected' : ''?> value="6">Prix compris entre 50 et 70 €</option>
                            <option <?=$budget == 7 ? 'selected' : ''?> value="7">Prix compris entre 70 et 100 €</option>
                            <option <?=$budget == 8 ? 'selected' : ''?> value="8">Plus de 100 €</option>
                        </select>
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto">
                            <?=$errors['budget'] ?? ""?></div>
                    </div>

                    <div class="form-group">
                        <label for="maxParticipant" class='montserrat'>Participant maximum</label>
                        <select name="maxParticipant"
                            class="form-control w-75 m-auto  <?=$isSubmitted && isset($errors['maxParticipant']) ? 'is-invalid' : ''?>"
                            id="
                        maxParticipant">
                            <option>Sélectionner le maximum de participant :</option>
                            <option <?=$maxParticipant == 1 ? 'selected' : ''?> value="1">1 personne</option>
                            <option <?=$maxParticipant == 2 ? 'selected' : ''?> value="2">2 personnes</option>
                            <option <?=$maxParticipant == 3 ? 'selected' : ''?> value="3">3 personnes</option>
                            <option <?=$maxParticipant == 4 ? 'selected' : ''?> value="4">4 personnes</option>
                            <option <?=$maxParticipant == 5 ? 'selected' : ''?> value="5">5 personnes</option>
                            <option <?=$maxParticipant == 6 ? 'selected' : ''?> value="6">6 personnes</option>
                            <option <?=$maxParticipant == 7 ? 'selected' : ''?> value="7">7 personnes</option>
                            <option <?=$maxParticipant == 8 ? 'selected' : ''?> value="8">8 personnes</option>
                            <option <?=$maxParticipant == 9 ? 'selected' : ''?> value="9">9 personnes</option>
                            <option <?=$maxParticipant == 10 ? 'selected' : ''?> value="10">10 personnes</option>
                            <option <?=$maxParticipant == 11 ? 'selected' : ''?> value="11">Entre 10 et 15 personnes
                            </option>
                            <option <?=$maxParticipant == 12 ? 'selected' : ''?> value="12">Entre 15 et 20 personnes
                            </option>
                            <option <?=$maxParticipant == 13 ? 'selected' : ''?> value="13">Entre 20 et 30 personnes
                            </option>
                            <option <?=$maxParticipant == 14 ? 'selected' : ''?> value="14">Entre 30 et 50 personnes
                            </option>
                        </select>
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto">
                            <?=$errors['maxParticipant'] ?? ""?></div>
                    </div>

                    <div class="form-group">
                        <label for="difficulty" class='montserrat'>Difficulté</label>
                        <select name="difficulty"
                            class="form-control w-75 m-auto  <?=$isSubmitted && isset($errors['difficulty']) ? 'is-invalid' : ''?>"
                            id="
                        difficulty">
                            <option>Sélectionner le niveau de difficulté :</option>
                            <option <?=$difficulty == 1 ? 'selected' : ''?> value="1">Facile</option>
                            <option <?=$difficulty == 2 ? 'selected' : ''?> value="2">Moyenne</option>
                            <option <?=$difficulty == 3 ? 'selected' : ''?> value="3">Difficile</option>

                        </select>
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto bg-danger w-50 text-white m-auto">
                            <?=$errors['difficulty'] ?? ""?></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label montserrat" for="dateOfEvents">Date de l'évènement :</label>
                        <input
                            class="form-control w-75 m-auto  <?=$isSubmitted && isset($errors['dateOfEvents']) ? 'is-invalid' : ''?>"
                            value="<?=$dateOfEvents?>" id="dateOfEvents" type="date" name="dateOfEvents"
                            placeholder="25/01/2021">
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto">
                            <?=$errors['dateOfEvents'] ?? ""?></div>
                    </div>

                    <div class="form-group">
                        <label class="control-label montserrat" for="location">Adresse :</label>
                        <input
                            class="form-control w-75 m-auto <?=$isSubmitted && isset($errors['location']) ? 'is-invalid' : ''?>"
                            value="<?=$location?>" id="location" name="location" type="text"
                            placeholder="29 rue gu grand boulevards">
                        <div class="invalid-feedback bg-danger w-50 text-white m-auto"><?=$errors['location'] ?? ""?>
                        </div>
                    </div>

                    <div class="form-group">
                        <div>
                            <label for="ville_code_postal" class='montserrat'>Code postal : </label>
                            <input class="form-control w-75 m-auto" type="text" name="ville_code_postal"
                                id="ville_code_postal">
                        </div>
                        <div>
                            <label for="ville_nom" class='montserrat mt-3'>Ville : </label>
                            <select name="ville_nom" id="ville_nom">
                                <option value=""></option>
                            </select>
                        </div>
                    </div>


                    <div class="form-group">
                        <label for="contentEvent" class='text-white'><span
                                class='text-white h5 border-bottom'>Un décriptif de l'événement :
                            </span></label>
                    </div>
                    <textarea class='rounded mt-3' id="contentEvent" name="contentEvent" rows="5" cols="50">
                            </textarea>

                    <div class="text-center"> <button type="submit" class="btn btn-warning " name='create'>Créér
                            l'évènement!</button></div>
                </div>

            </div>
        </form>
    </div>

</div>
</div>

<script src="../assets/libs/js/jquery-3.4.1.min.js"></script>
<script src="../assets/libs/js/bootstrap.bundle.min.js"></script>
<script src="../assets/libs/js/jquery.js"></script>
<script src="../assets/js/script.js"></script>
<!-- <script src="../assets/js/ajax.js"></script> -->

</body>
</html>