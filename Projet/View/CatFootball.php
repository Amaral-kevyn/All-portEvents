<main>
        <div class="contenair-fluidFootball">
            <div class="row">
                <div class="col-12 text-center my-5 text-white">
                    <h2>Choisit le style d'evenement que tu veux faire</h2>
                </div>
                <div class="col-12">
                    <h3 id='motoBalade' class='text-center text-white h1' style='border-bottom: 1rem solid;'>Match</h3>
                      <div class="row justify-content-around">
                        <?php if (count($eventsList) > 0) { 
                        foreach ($eventsList as $number => $event) { 
                          if($event->typeOfEvents_id == '6' && $event->activityOfEvents_id == '8'){
                            include 'includes/eventShow.php'; 
                    }}} else { ?>
                                <h4 class="text-center text-white mt-4 mb-4">Aucun événements n'as été créer pour le moment.
                                </h4>
                        <?php } ?>
                        </div>
                          
                </div>
                <div id='FreestyleFootball' class="col-12">
                    <h3 class='text-center text-white h1' style='border-bottom: 1rem solid;'>Freestyle</h3>
                    <div class="row justify-content-around">
                        <?php if (count($eventsList) > 0) { 
                        foreach ($eventsList as $number => $event) { 
                            if($event->typeOfEvents_id == '6' && $event->activityOfEvents_id == '2'){
                                include 'includes/eventShow.php'; 
                        }}} else { ?>
                                <h4 class="text-center text-white mt-4 mb-4">Aucun événements n'as été créer pour le moment.
                                </h4>
                        <?php } ?>
                        </div>
                </div>

                <div id='FootSalleFootball' class="col-12">
                    <h3 class='text-center text-white h1' style='border-bottom: 1rem solid;'>Foot Salle</h3>
                    <div class="row justify-content-around">
                        <?php if (count($eventsList) > 0) { 
                        foreach ($eventsList as $number => $event) { 
                            if($event->typeOfEvents_id == '6' && $event->activityOfEvents_id == '9'){
                                include 'includes/eventShow.php'; 
                        }}} else { ?>
                                <h4 class="text-center text-white mt-4 mb-4">Aucun événements n'as été créer pour le moment.
                                </h4>
                        <?php } ?>
                        </div>
                </div>
            </div>
        </div>
    </main>


<?php
include 'footer.php';