<?php 
$title = 'Accueil';
ob_start(); ?>

<!--<div class="filtres">
<div class="form-group filtre_theme">
    <select class="form-control" id="exampleFormControlSelect1">
      <option selected>Thème</option>

    </select>
</div>
<div class="form-group filtre_gratuit">
    <select class="form-control" id="exampleFormControlSelect1">
      <option selected>Type de vidéo</option>
      <option>Gratuites</option>
      <option>Payantes</option>
    </select>
</div>
<div class="input-group search_video">
  <div class="input-group-prepend">
    <span class="input-group-text"><i class="fas fa-search"></i></span>
  </div>
  <input class="form-control" type="search" placeholder="Rechercher une vidéo..." aria-label="Search">
</div>
</div>-->

    <div class="col-sm-12 col-md-12 col-lg-10 list_videos">
    <h1> Les dernières vidéos </h1>
    <?php foreach ($videos as $video) : ?>

    <div class="elmt_video">
      <div class="card mb-4 shadow-sm">
        <div class="video"> 
        <iframe src="https://www.youtube.com/embed/<?= $video['lien']; ?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
        <?php if (!$video['gratuite']) : ?>
          <div class="blur"> <p> <i class="fas fa-lock"></i> Contenu payant </p> </div>
        <?php endif; ?>
        </div>
        <div class="card-body">
          <h2 class="title"> <?= $video['titre']; ?> 
          <span class="badge badge-secondary" style="background:<?= $video['couleur']; ?>"><?= $video['theme']; ?></span> 
          </h2>
          <div>
            <?= ($video['gratuite']) ? '<a role="button" class="btn btn-sm btn-show btn-success" href="#"><i class="fas fa-eye"></i>Voir</a>' : '<a role="button" class="btn btn-sm btn-show btn-primary" href="#"><i class="fas fa-euro-sign"></i>Acheter</a>'  ; ?>
          </div>
          <div class="d-flex justify-content-between align-items-center infos">
          <?= ($video['gratuite']) ? '<p class="text-muted free">Gratuite</p>' : '<p class="text-muted price">'.$video['prix'].'€</p>'; ?>
          </div>
        </div>
        </div>
    </div>

    <?php endforeach; ?>
    </div>

<?php $content = ob_get_clean();

require ('view/template.php'); ?>