<nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background-color: #4A5890;">
  <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"> </span>
  </button>
  <a id='HomeMaxScreen' class="navbar-brand font-weight-bold ml-auto mr-auto" href="../Accueil">
    <h6 style="color: rgb(255, 140, 8);font-size='6em'; font-family: 'Montserrat', sans-serif;letter-spacing:-0.1em;"><i class="fa fa-home text-white"
        aria-hidden="true"></i> Accueil</h6>
  </a>
  <a id='MinMaxScreen' class="navbar-brand font-weight-bold ml-auto mr-auto " href="../Accueil">
   <i class="fa fa-home text-white h2" aria-hidden="true"></i>
  </a>

  
  


  <div class="collapse navbar-collapse justify-content-center align-items-around" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mt-2 mt-md-0 ml-3">
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3 Montserrat" href="../Motorcycle"><i class="fa fa-motorcycle p-1 rouge"
            aria-hidden="true"></i>Motorcycle</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3 Montserrat" href="../Velo"><i class="fa fa-bicycle p-1 violet "
            aria-hidden="true"></i>Cyclisme</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3 Montserrat"href="../Course_a_pied"><i class='fas p-1 rose'>&#xf70c;</i>Course à
          pied</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3 Montserrat" href="../Roller"><i
            class="fas fa-skating p-1 orange"></i>Roller</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3 Montserrat" href="../Skate"><i class='fas p-1'>&#xf7ce;</i>Skate</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3 Montserrat" href="../Football"><i
            class="fas fa-futbol p-1 vert"></i>Football</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3 Montserrat" href="../Tennis"><i
            class='fas p-1 jaune'>&#xf45d;</i></i>Tennis</a>
      </li>
    </ul>

  </div>
  <div class='logo'>
  <?php
  // affiche le lien de connexion si la session est absente
  if (!isset($_SESSION['user'])) {
?>
    <a class="btn btn-outline-success text-success font-weight-bold mr-2" data-toggle="tooltip" title='Se Connecter' href="../Connexion#loginPlacement"><img src="../assets/img/login.svg" style='width:2em;border-radius:50%;' class="img-fluid bg-success " alt="connexion"></a>
<?php
  }
  // sinon affiche le bouton de deconnexion
  else{
?>
    <!-- le $_GET logout sert à déclencher la deconnexion -->
    <a class="btn btn-outline-danger text-danger font-weight-bold mr-2" data-toggle="tooltip" title='Se Déconnecter' href="../Connexion?logout=true"><img src="../assets/img/login.svg" style='width:2em;border-radius:50%;' class="img-fluid bg-danger" alt="deconnexion"></a>
<?php
  }
?>
</div>
  <div class='imgProfilePc text-center'>
    <?php
        if (isset($_SESSION['user']) && $photo != NULL): ?>
          <img class="img-fluid p-1" style="width:4em;border-radius:50%;" src="<?= $photo ?>" alt="profile picture">
        <?php else: ?>
            <img class="img-fluid p-1" style="width:4em;border-radius:50%;" src="../assets/img/avatar.jpg" alt="Avatar par default">
        <?php endif; 

    if (isset($_SESSION['user']['users_id'])){ ?>
      <p><span class="montserrat text-capitalize p-1"
        style=" color: rgb(255, 140, 8);"><?= /* Première lettre en MAJ */ substr($_SESSION['user']['pseudo'],0,6).'**'?></span></p>
    
    <?php
  }
?>
  </div>
</nav>