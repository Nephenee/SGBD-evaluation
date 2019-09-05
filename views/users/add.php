<?php
    require_once('models/user.php');

    use \User as User;

    $message = '';

    if(!isset($_SESSION['user']) || $_SESSION['user']->role !== 'admin') {
        header("Location: /");
        exit;

    } else {
        if($_POST) {
            $user = User\add($_POST['firstname'], $_POST['lastname'], $_POST['email'], $_POST['adress'], $_POST['password']);

            if ($user) {
                $message = 'Utilisateur enregistré';
            } else {
                $message = 'Erreur : Veuillez recommencer';
            }
        }
    }
    
?>

<section class="ctn">
    <section class="section">
        <h2 class="subtitle subtitle--connect">Inscription utilisateur</h2>
        <div class="form__error"><?= $message ?></div>
        <form class="form" method="POST" action="">
            <input class="form__input" type="text" name="firstname" placeholder="Prénom" required />
            <input class="form__input" type="text" name="lastname" placeholder="Nom" required />
            <input class="form__input" type="text" name="email" placeholder="Email" required />
            <input class="form__input" type="text" name="adress" placeholder="Adresse" required />
            <input class="form__input" type="password" name="password" placeholder="Mot de passe" required />
            <button class="form__button" type="submit">Valider</button>
        </form>
    </section>
</section>