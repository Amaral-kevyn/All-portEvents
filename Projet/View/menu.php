<main class="container-fluid  ml-1 mr-1 mt-5 mb-5">
        <div class="row justify-content-around">
            <div id='menuPlacement' class="col-12 text-center mt-3 mb-5 orange h3 montserrat" style='border-bottom: 1rem solid;'>Menu</div>
            <a href='../Controller/users_ctrl.php?users_id=#userPlace'.<?=$_SESSION['user']['users_id'];?> class='btn btn-outline-secondary text-white'>Mon Profil</a>
            <a href='../Controller/listUsers_ctrl.php' class='btn btn-outline-secondary text-white'>Liste Utilisateur</a>
            <a href='#' class='btn btn-outline-secondary text-white'>Evènement Créé</a>
            <a href='#' class='btn btn-outline-secondary text-white'>Participation Evènement </a>

        </div>
    </main>

<?php
	include 'footer.php';
?>