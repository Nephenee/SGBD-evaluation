<?php
    require_once('models/cart.php');

    use \Cart as Cart;

    if ($_GET['page'] === 'bill') {
        var_dump($_SESSION['user']->user_id);die;
        $bill = Cart\getBill($_SESSION['user']->user_id);
    }
?>

BILL