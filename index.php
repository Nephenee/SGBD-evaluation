<?php
    require_once('services/app.php');
    include_once('templates/header.php');

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

        case 'lasts':
            include_once('views/products/articles.php');
            break;
        
        case 'add_article':
            include_once('views/products/add.php');
            break;

        case 'update_article':
            include_once('views/products/add.php');
            break;
        
        case 'logout':
            session_destroy();
            var_dump($_SESSION);
            header("Location: /index.php");
            exit;
            break;
        
        default:
            include_once('views/home.php');
            break;
    }

    include_once('templates/footer.php');
?>
