<main class="container-fluid  ml-1 mr-1">
<div class="row justify-content-around">
<?php if (count($eventsList) > 0) { 
foreach ($eventsList as $number => $event) { 
        include 'includes/eventShow.php'; 
}} else { ?>
        <h4 class="text-center text-white mt-4 mb-4">Aucun événements n'as été créer pour le moment.
        </h4>
<?php } ?>
</div>

</main>
<?php include 'footer.php';