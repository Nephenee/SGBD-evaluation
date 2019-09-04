<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://fonts.googleapis.com/css?family=Lato:100,100i,300,300i,400,400i,700,700i,900,900i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Damion&display=swap" rel="stylesheet">
    <Link href="reset.css" rel="stylesheet" />
    <Link href="styles.css" rel="stylesheet" />
    <title>AroBioHuiles</title>
</head>
<body class="body">
<header class="header">
    <nav class="header__nav">
        <ul class="header__nav__list">
            <li><a href="index.php?page=home">Accueil</a></li>
            <?php if(isset($_SESSION['user'])): ?>
                <li><a href="index.php?page=products">Articles</a></li>
                <li><a href="index.php?page=lasts">Dernières actus</a></li>
                <ul>
                    <li><a href=""><?= $_SESSION['user']->firstname ?></a></li>
                    <li><a href="index.php?page=cart">Panier</a></li>
                    <?php if ($_SESSION['user']->role === 'admin'): ?>
                        <li><a href="index.php?page=users">Utilisateurs</a></li>
                    <?php endif; ?>
                    <li><a href="index.php?page=logout">Se déconnecter</a></li>
                </ul>
            <?php else: ?>
                <li><a href="index.php?page=ask">S'enregistrer</a></li>
                <li><a href="index.php?page=login">Se connecter</a></li>
            <?php endif; ?>    
        </ul>
    </nav>
</header>