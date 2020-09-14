<nav class="navbar fixed-top navbar-expand-lg navbar-light" style="background-color: #4A5890;">
  <button class="navbar-toggler bg-white" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
    aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"> </span>
  </button>
  <a class="navbar-brand font-weight-bold font-italic ml-auto mr-auto" href="../Accueil">
    <h6 style="color: rgb(255, 140, 8);font-size='6em'; font-family: 'Indie Flower';"><i class="fa fa-home text-white"
        aria-hidden="true"></i> Accueil</h6>
  </a>
  
  


  <div class="collapse navbar-collapse justify-content-center align-items-around" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto mt-2 mt-md-0 ml-3">
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3" href="../Motorcycle"><i class="fa fa-motorcycle p-1 rouge"
            aria-hidden="true"></i>Motorcycle</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3" href="../Velo"><i class="fa fa-bicycle p-1 violet "
            aria-hidden="true"></i>Cyclisme</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3" href="../Course_à_pied"><i class='fas p-1 rose'>&#xf70c;</i>Course à
          pied</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3" href="../Roller"><i
            class="fas fa-skating p-1 orange"></i>Roller</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3" href="../Skate"><i class='fas p-1'>&#xf7ce;</i>Skate</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3" href="../Football"><i
            class="fas fa-futbol p-1 vert"></i>Football</a>
      </li>
      <li class=" nav-item">
        <a class="nav-link text-white h5 p-3" href="../Tennis"><i
            class='fas p-1 jaune'>&#xf45d;</i></i>Tennis</a>
      </li>
    </ul>

  </div>
  <div class='logo'>
  <?php
  // affiche le lien de connexion si la session est absente
  if (!isset($_SESSION['user'])) {
?>
    <a class="btn btn-outline-success text-success font-weight-bold ml-2 mr-2" data-toggle="tooltip" title='Se Connecter' href="../Inscription/Connexion#FormInsCon"><img src="../assets/img/login.svg" style='width:2em;border-radius:50%;' class="img-fluid bg-success " alt="connexion"></a>
<?php
  }
  // sinon affiche le bouton de deconnexion
  else{
?>
    <!-- le $_GET logout sert à déclencher la deconnexion -->
    <a class="btn btn-outline-danger text-danger font-weight-bold mb-3 ml-2 mr-2" data-toggle="tooltip" title='Se Déconnecter' href="../Inscription/Connexion?logout=true"><img src="../assets/img/login.svg" style='width:2em;border-radius:50%;' class="img-fluid bg-danger" alt="deconnexion"></a>
<?php
  }
?>
</div>
  <div class='imgProfilePc'>
    <?php
  if (isset($_SESSION['user'])) { ?>
    <img class="img-fluid ml-2" style="border-radius:50%;" width='40em' src="../assets/img/<?=$photo?>" alt="<?=$photo?>">
    <p>
      <span class="h5 ml-1"
        style=" color: rgb(255, 140, 8);"><?= /* Première lettre en MAJ */ ucfirst($_SESSION['user']['login1'])?></span>
    </p>
    <?php
  }
?>


  </div>
  
</nav>