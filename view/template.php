<?php require ('inc/head.php'); ?>

  <body>

    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-2 side_nav">
          <h1><i class="fas fa-video"></i><strong>D<span class="violet">o</span>ntatune</strong></h1>
          <div class="filters">
            <div class="filter-item active">
              <i class="fas fa-home"></i><a href="home">Accueil</a>
            </div>
            <div class="filter-item">
              <i class="fas fa-search"></i><a href="#">Rechercher</a>
            </div>
            <div class="filter-item">
              <i class="fas fa-user"></i><a href="#">Profil</a>
            </div>
          </div>
          <a role="button" class="btn btn-success" href="abonnement"><i class="fas fa-video"></i>S'abonner</a>
        </div>
        <div class="col-sm-12 nav_mobile">
        <div class="open">
            <div class="bar1"></div>
            <div class="bar2"></div>
            <div class="bar3"></div>
        </div>
        <div class="items">
          <h1><i class="fas fa-video"></i><strong>D<span class="violet">o</span>ntatune</strong></h1>
        </div>
        </div>
          <?= $content; ?>
      </div>
    </div>

    <div class="side_nav_mobile" id="side_nav_mobile"> 
      <div class="filters_nav">
          <a href="home">Accueil</a>
          <a href="#">Rechercher</a>
          <a href="#">Profil</a>
          <a role="button" class="btn btn-success" href="abonnement"><i class="fas fa-video"></i>S'abonner</a>
      </div>
    </div>

    <?php require ('inc/end.php'); ?>
  </body>
</html>
