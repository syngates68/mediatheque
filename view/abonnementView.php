<?php 
$title = 'Abonnement';
ob_start();
?>

<div class="col-sm-12 col-md-12 col-lg-10 abonnement">

    <h1>Abonnements</h1>

    <div class="container">
      <div class="card-deck mb-3 text-center">

        <?php foreach ($abos as $abo) : ?>
        <div class="elmt_abo">
        <div class="card mb-4 shadow-sm">
          <div class="card-header">
            <h4 class="my-0 font-weight-normal"><?= $abo['nom']; ?></h4>
          </div>
          <div class="card-body">
            <button type="button" class="btn btn-lg btn-block btn-outline-primary"><?= ($abo['essai'] == 1) ? 'Essayer' : 'Souscrire'; ?></button>
          </div>
        </div>
        </div>
        <?php endforeach; ?>

      </div>
    </div>

</div>

<?php
$content = ob_get_clean();

require('view/template.php');