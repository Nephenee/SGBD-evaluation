<?php
    require_once('models/user.php');

    use \User as User;

    $error = '';

    if($_POST) {
        $auth = User\auth($_POST['email'], $_POST['password']);

        if ($auth) {
            header("Location: /index.php");
            exit;
        } else {
            $error = 'Erreur : identifiants invalides';
        }
    }
?>

<section class="ctn">
    <section class="section">
        <h2 class="subtitle subtitle--connect">Connectez-vous</h2>
        <div class="form__error"><?= $error ?></div>
        <form class="form" method="POST" action="">
            <input class="form__input" type="email" name="email" placeholder="Email" />
            <input class="form__input" type="password" name="password" placeholder="Mot de passe" />
            <button class="form__button" type="submit">Valider</button>
        </form>
    </section>
</section>
