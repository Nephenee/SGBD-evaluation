<?php
    require_once('models/cart.php');

    use \Cart as Cart;

    $message = [];
    $messages = ['Votre panier est vide'];

    if ($_GET['page'] === 'cart') {
        if (count($_SESSION['cart']) > 0) {
            $products = Cart\getAll($_SESSION['cart']);
            $newProducts = [];
            $total = 0;
    
            foreach ($products as $product) {
                if (isset($newProducts[$product->product_id])) {
                    $product->quantity = $product->quantity + 1;
                    $product->price = number_format($product->price + $product->price, 2);
                } else {
                    $product->quantity = 1;
                }
                
                $newProducts[$product->product_id] = $product;
            }

            foreach ($newProducts as $product) {
                $total = number_format($total + $product->price, 2);
            }

        } else {
            $message = $messages[0];
        }
    } else if ($_GET['page'] === 'delete_cart') {

    }

?>

<section class="ctn">
    <div class="cart__content">
        <h2 class="subtitle">Mon panier</h2>
        <ul class="cart__list">
            <?php foreach ($newProducts as $product): ?>
                <li class="cart__list__item">
                    <img class="cart__item__img" alt="<?= $product->name ?>" src="images/<?= $product->image ?>" />
                    <h2 class="cart__item__title"><?= $product->name ?></h2>
                    <p class="cart__item__description"><?= $product->description ?></p>
                    <p class="cart__item__price"><?= $product->price ?> €</p>
                    <button class="form__button form__button--cart">
                        <a class="link" href="index.php?page=delete_cart&id=<?= $product->product_id ?>&message=2">X</a>
                    </button>
                </li>
            <?php endforeach; ?>
            <div class="cart__total">
                <p class="total__price">Total : <span class="total__price__number"><?= $total ?> €</span></p>
                <button class="form__button"><a class="link" href="index.php?page=add_product">Valider</a></button>
            </div>
        </ul>
    </div>
</section>