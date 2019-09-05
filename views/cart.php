<?php
    require_once('models/cart.php');

    use \Cart as Cart;

    $message = '';
    $messages = ['Votre panier est vide', 'Erreur : Veuillez recommencer'];

    if ($_GET['page'] === 'cart') {
        if (count($_SESSION['cart']) > 0) {
            $products = Cart\getAll($_SESSION['cart']);

        } else {
            $message = $messages[0];
        }

    } else if ($_GET['page'] === 'delete_cart') {
        if (array_key_exists('id', $_GET)) {
            $key = array_search($_GET['id'], $_SESSION['cart']);
            unset($_SESSION['cart'][$key]);
            
            if (count($_SESSION['cart']) > 0) {
                $products = Cart\getAll($_SESSION['cart']);
    
            } else {
                $message = $messages[0];
            }

        } else {
            $message = $messages[1];
        }


        if (count($_SESSION['cart']) > 0) {
            $products = Cart\getAll($_SESSION['cart']);

        } else {
            $message = $messages[0];
        }

    } else if ($_GET['page'] === 'valid_cart') {
        $products = Cart\getAll($_SESSION['cart']);

        foreach ($products as $product) {
            $product->quantity = $_SESSION['cart'][$product->product_id];
            $product->totalPrice = $product->price * $product->quantity;
            $product->formatedPrice = number_format($product->totalPrice, 2);
        }

        $bill = Cart\addBill(
            $_SESSION['cart'],
            number_format(array_sum(array_column($products, 'totalPrice')), 2),
            $_SESSION['user']->user_id
        );

        $_SESSION['cart'] = [];
        header("Location: /index.php?page=bill");
        exit;
    }

?>

<section class="ctn">
    <div class="cart__content">
        <h2 class="subtitle">Mon panier</h2>
        <div class="form__error"><?= $message ?></div>
        <ul class="cart__list">
            <?php if (count($_SESSION['cart']) > 0):
                foreach ($products as $product): 
                    $product->quantity = $_SESSION['cart'][$product->product_id];
                    $product->totalPrice = $product->price * $product->quantity;
                    $product->formatedPrice = number_format($product->totalPrice, 2);
                ?>
                    <li class="cart__list__item">
                        <img class="cart__item__img" alt="<?= $product->name ?>" src="images/<?= $product->image ?>" />
                        <h2 class="cart__item__title"><?= $product->name ?></h2>
                        <p class="cart__item__description"><?= $product->description ?></p>
                        <p class="cart__item__price"><?= $product->quantity ?></p>
                        <p class="cart__item__price"><?= $product->formatedPrice ?> €</p>
                        <button class="form__button form__button--cart">
                            <a class="link" href="index.php?page=delete_cart&id=<?= $product->product_id ?>&message=2">X</a>
                        </button>
                    </li>
                <?php endforeach; ?>
                <div class="cart__total">
                    <p class="total__price">Total : <span class="total__price__number"><?= number_format(array_sum(array_column($products, 'totalPrice')), 2); ?> €</span></p>
                    <button class="form__button"><a class="link" href="index.php?page=valid_cart">Valider</a></button>
                </div>
            <?php endif; ?>
        </ul>
    </div>
</section>