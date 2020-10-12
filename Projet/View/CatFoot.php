<main>
        <div class="contenair-fluidFoot">
            <div class="row">
                <div class="col-12 text-center my-5 text-white">
                    <h2>Choisit le style d'evenement que tu veux faire</h2>
                    
                </div>
                <div class="col-12">
                    <h3 id='footBalade' class='text-center text-white h1' style='border-bottom: 1rem solid;'>Balade</h3>
                    <div class="row justify-content-around">
                        <?php if (count($eventsList) > 0) { 
                        foreach ($eventsList as $number => $event) { 
                            if($event->typeOfEvents_id == '3' && $event->activityOfEvents_id == '1'){
                                include 'includes/eventShow.php'; 
                        }}} else { ?>
                                <h4 class="text-center text-white mt-4 mb-4">Aucun événements n'as été créer pour le moment.
                                </h4>
                        <?php } ?>
                        </div>
                        
                </div>
                <div class="col-12">
                    <h3 id='footTrails' class='text-center text-white h1' style='border-bottom: 1rem solid;'>Trails</h3>
                    <div class="row justify-content-around">
                        <?php if (count($eventsList) > 0) { 
                        foreach ($eventsList as $number => $event) { 
                            if($event->typeOfEvents_id == '3' && $event->activityOfEvents_id == '7'){
                                include 'includes/eventShow.php'; 
                        }}} else { ?>
                                <h4 class="text-center text-white mt-4 mb-4">Aucun événements n'as été créer pour le moment.
                                </h4>
                        <?php } ?>
                        </div>
                </div>

                <div class="col-12">
                    <h3 id='footCourse' class='text-center text-white h1' style='border-bottom: 1rem solid;'>Course</h3>
                    <div class="row justify-content-around">
                        <?php if (count($eventsList) > 0) { 
                        foreach ($eventsList as $number => $event) { 
                            if($event->typeOfEvents_id == '3' && $event->activityOfEvents_id == '4'){
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