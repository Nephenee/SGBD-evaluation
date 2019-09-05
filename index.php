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

        case 'users':
            include_once('views/users/add.php');
            break;
        
        case 'products':
            include_once('views/products/products.php');
            break;

        case 'lasts':
            include_once('views/products/products.php');
            break;
        
        case 'add_product':
            include_once('views/products/add.php');
            break;

        case 'update_product':
            include_once('views/products/add.php');
            break;

        case 'cart':
            include_once('views/cart.php');
            break;

        case 'add_cart':
            include_once('views/products/products.php');
            break;

        case 'delete_cart':
            include_once('views/cart.php');
            break;

        case 'valid_cart':
            include_once('views/cart.php');
            break;
        
        case 'bill':
            include_once('views/bill.php');
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
