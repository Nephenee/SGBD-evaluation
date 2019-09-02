<?php
    require_once('services/app.php');
    include_once('templates/header.php');
    /* TODO: faire un switch pour que l'index.php soit un controlleur frontal */

    if (!isset($_GET['page'])) {
        $page = 'home';
    } else {
        $page = $_GET['page'];
    }

    switch ($page) {
        case 'home':
            include_once('views/home.php');
            break;

        case 'login':
            include_once('views/login.php');
            break;
        
        case 'articles':
            include_once('views/products/articles.php');
            break;
        
        case 'add_article':
            include_once('views/products/add.php');
            break;
        
        default:
            include_once('views/home.php');
            break;
    }

    include_once('templates/footer.php');
?>
