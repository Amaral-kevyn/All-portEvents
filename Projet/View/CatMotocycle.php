<main>
      <div class="contenair-fluidMoto">
        <div class="row">
          <div class="col-12 text-center my-5 text-white">
            <h2>Choisit le style d'evenement que tu veux faire</h2>
          </div>
          <!--Carte de la catégorie moto avec l'activité match-->
          <div class="col-12">
                    <h3 id='motoBalade' class='text-center text-white h1' style='border-bottom: 1rem solid;'>Balade</h3>
                      <div class="row justify-content-around">
                        <?php if (count($eventsList) > 0) { 
                        foreach ($eventsList as $number => $event) { 
                          if($event->typeOfEvents_id == '1' && $event->activityOfEvents_id == '1'){
                            include 'includes/eventShow.php'; 
                    }}} else { ?>
                                <h4 class="text-center text-white mt-4 mb-4">Aucun événements n'as été créer pour le moment.
                                </h4>
                        <?php } ?>
                        </div>   
                </div>
                <!--Carte de la catégorie moto avec l'activité circuits-->
                <div class="col-12">
                    <h3 id='motoCircuit' class='text-center text-white h1'style='border-bottom: 1rem solid;'>Circuit</h3>
                    <div class="row justify-content-around">
                        <?php if (count($eventsList) > 0) { 
                        foreach ($eventsList as $number => $event) { 
                          if($event->typeOfEvents_id == '1' && $event->activityOfEvents_id == '5'){
                            include 'includes/eventShow.php'; 
                    }}} else { ?>
                                <h4 class="text-center text-white mt-4 mb-4">Aucun événements n'as été créer pour le moment.
                                </h4>
                        <?php } ?>
                        </div>
                </div>
                  <!--Carte de la catégorie moto avec l'activité Enduro-->
                <div class="col-12">
                    <h3 id='motoEnduro' class='text-center text-white h1'style='border-bottom: 1rem solid;'>Enduro</h3>
                    <div class="row justify-content-around">
                      <?php if (count($eventsList) > 0) { 
                      foreach ($eventsList as $number => $event) { 
                        if($event->typeOfEvents_id == '1' && $event->activityOfEvents_id == '3'){
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
