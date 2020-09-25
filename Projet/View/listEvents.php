<main class="container-fluid  ml-1 mr-1">
        <div class="row justify-content-around">

                <?php if (count($eventsList) > 0) { 
                foreach ($eventsList as $number => $event) { ?>

                 <div id='eventListPlace' class="card-user-list col-8 col-sm-6 col-md-3 mt-4 mb-4">
                        <div class="card-body bg-light text-center border rounded border-info">
                                <p class="card-text orange montserrat noirBackground ">Date de publication :<span
                                                class='text-white'>
                                                <?= $event->dateOfPublication; ?></span></p>

                                <?php switch ($event->typeOfEvents_id) {
                                         case 1: ?>
                                <img class="img-fluid w-100 mb-3" style='height:9em;'
                                        src="/assets/img/damon-hypersport-moto-electrique.jpg" alt="moto">
                                <?php break;
                                         case 2: ?>
                                <img class="img-fluid w-100 mb-3" style='height:9em;'
                                        src="/assets/img/velo-de-randonnee.jpg" alt="velo">
                                <?php  break; 
                                        default:?>
                                <img class="img-fluid w-100 mb-3" src="/assets/img/Sans titre.png" alt="multi">
                                <?php } ?>

                                <p class="card-text jaune montserrat noirCard">Evénement n° : <span class='text-white'>
                                                <?= $number + 1; ?></span></p>
                                <p class="card-text jaune montserrat noirCard">Nom de l'organisateur : <span
                                                class='text-white'>
                                                <?= $event->pseudo; ?></span></p>

                                <p class="card-text orange montserrat noirCard">Type d'événement : <span
                                                class='text-white'>

                                                <?php switch ($event->typeOfEvents_id) {
                                                case 1: 
                                                        echo'Moto';
                                                break;
                                                case 2: 
                                                        echo'Vélo';
                                                break; 
                                                default:
                                                        echo'Type';
                                                } ?></span></p>


                                <p class="card-text orange montserrat noirCard">Date événement : <span
                                                class='text-white'>
                                                <?= $event->dateOfEvents_format.' '.$event->time;?> </span></p>

                                <p class="card-text orange montserrat noirCard">Adresse :<span class='text-white'>
                                                <?= $event->location; ?></span></p>

                                <p class="card-text orange montserrat noirCard">Ville : <span
                                                class='text-white text-capitalize'>
                                                <?= $event->ville_nom; ?></span></p>
                                <p class="card-text orange montserrat noirCard">Code Postale : <span class='text-white'>
                                                <?= $event->ville_code_postal; ?></span></p>

                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                        data-target="#exampleModal<?= $event->events_id;?>">
                                        + Voir plus
                                </button>

                                <!-- Modal -->
                                <div class="modal" id="exampleModal<?= $event->events_id;?>" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                        <div class="modal-header bg-secondary">
                                                                <h5 class="modal-title montserrat"
                                                                        id="exampleModalLabel">Plus d'informations </h5>
                                                                <button type="button" class="close" data-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <span aria-hidden="true">&times;</span>
                                                                </button>
                                                        </div>
                                                        <div class="modal-body noirModal">

                                                                <p class="card-text orange montserrat">Budget : <span
                                                                                class='text-white'>

                                                                                <?php switch ($event->budget) {
                                                                                case 1: 
                                                                                echo'Gratuit';
                                                                                break;
                                                                                case 2: 
                                                                                echo'Prix compris entre 0 et 10 €';
                                                                                break; 
                                                                                case 3: 
                                                                                echo'Prix compris entre 10 et 20 €';
                                                                                break;
                                                                                case 4: 
                                                                                echo'Prix compris entre 20 et 40 €';
                                                                                break; 
                                                                                case 5: 
                                                                                echo'Prix compris entre 40 et 50 €';
                                                                                break;
                                                                                case 6: 
                                                                                echo'Prix compris entre 50 et 70 €';
                                                                                break; 
                                                                                case 7: 
                                                                                echo'Prix compris entre 70 et 100 €';
                                                                                break; 
                                                                                case 8: 
                                                                                echo'Plus de 100 €';
                                                                                break; 
                                                                                default:
                                                                                echo'Prix';
                                                                                } ?></span></p>

                                                <p class="card-text orange montserrat noirModal">
                                                        Participant maximum :<span class='text-white'>

                                                                <?php switch ($event->budget) {
                                                                                case 1: 
                                                                                echo'1 personne';
                                                                                break;
                                                                                case 2: 
                                                                                echo'2 personnes';
                                                                                break; 
                                                                                case 3: 
                                                                                echo'3 personnes';
                                                                                break;
                                                                                case 4: 
                                                                                echo'4 personnes';
                                                                                break; 
                                                                                case 5: 
                                                                                echo'5 personnes';
                                                                                break;
                                                                                case 6: 
                                                                                echo'6 personnes';
                                                                                break; 
                                                                                case 7: 
                                                                                echo'7 personnes';
                                                                                break; 
                                                                                case 8: 
                                                                                echo'8 personnes';
                                                                                case 9: 
                                                                                echo'9 personnes';
                                                                                break; 
                                                                                case 10: 
                                                                                echo'10 personnes';
                                                                                case 11: 
                                                                                echo'Entre 10 et 15 personnes';
                                                                                break; 
                                                                                case 12: 
                                                                                echo'Entre 15 et 20 personnes';
                                                                                break; 
                                                                                case 13: 
                                                                                echo'Entre 20 et 30 personnes';
                                                                                break; 
                                                                                case 14: 
                                                                                echo'Entre 30 et 50 personnes';
                                                                                break; 
                                                                                default:
                                                                                echo'N° Participant';
                                                                                } ?></span></p>


                                        <p class="card-text orange montserrat noirModal">
                                                Difficulté :<span class='text-white'>

                                                                                <?php switch ($event->difficulty) {
                                                                                case 1: 
                                                                                echo'Facile';
                                                                                break;
                                                                                case 2: 
                                                                                echo'Moyenne';
                                                                                break; 
                                                                                case 3: 
                                                                                echo'Difficile';
                                                                                break;
                                                                                default:
                                                                                echo'Niveau';
                                                                                } ?></span></p>
                                                                <p class="card-text orange montserrat noirModal">
                                                                        Déscriptif de l'événement :</p>
                                                                <p class='text-white montserrat'>
                                                                        <?= $event->contentEvent; ?></p>
                                                        </div>
                                                        <div class="modal-footer bg-secondary">
                                                                <button type="button" class="btn btn-danger montserrat"
                                                                        data-dismiss="modal">Retour</button>
                                                                <a type="button"
                                                                        class="btn btn-primary text-white montserrat">Participer</a>
                                                        </div>
                                                </div>
                                        </div>
                                </div>

                        </div>
                </div>
                <?php } ?>
                <?php } else { ?>
                <h4 class="text-center text-white mt-4 mb-4">Aucun événements n'as été créer pour le moment.
                </h4>
                <?php } ?>

        </div>
</main>

<?php
	include 'footer.php';