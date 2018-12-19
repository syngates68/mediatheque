<?php
$title = "Connexion";
require ('inc/head.php');
?>

<body class="login_body">
<div class="filter_black">
    <h1><i class="fas fa-video"></i>D<span class="violet">o</span>ntatune</h1>
    <h2> Plateforme de vidéos en ligne </h2>

    <div class="container-fluid sign">
    <div class="row">
        <div class="col-sm-6 sign_in" id="sign_in">
            <form>
            <h3> C<span class="violet">o</span>nnexion </h3>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                <input type="text" class="form-control" id="username" placeholder="Nom d'utilisateur ou email">
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </div>
                <input type="password" class="form-control" id="password" placeholder="Mot de passe">
            </div>
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                <label class="form-check-label" for="exampleCheck1">Se souvenir de moi</label>
            </div>
            <button id="btn_sign_in" class="btn btn-primary">Connexion</button>
            </form>
        </div>
        <div class="col-sm-6 sign_up">
            <form>
            <h3> Inscripti<span class="violet">o</span>n </h3>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-at"></i></div>
                </div>
                <input type="mail" class="form-control" placeholder="Adresse mail">
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-user"></i></div>
                </div>
                <input type="text" class="form-control" placeholder="Nom d'utilisateur">
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </div>
                <input type="password" class="form-control" placeholder="Mot de passe">
            </div>
            <div class="input-group mb-2">
                <div class="input-group-prepend">
                <div class="input-group-text"><i class="fas fa-lock"></i></div>
                </div>
                <input type="password" class="form-control" placeholder="Confirmation">
            </div>
            <button type="submit" class="btn btn-success">Inscription</button>
            </form>
        </div>
    </div>
    </div>
</div>

</body>

<?php
require ('inc/end.php');
?>
