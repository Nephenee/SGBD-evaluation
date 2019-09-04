<?php
    require_once('models/product.php');

    use \Product as Product;

    $message = '';
    $messages = [
        'Produit ajouté',
        'Produit modifié',
        'Produit ajouté au panier',
        'Erreur : veuillez recommencer',
        'Produit supprimé',
        'Erreur : aucun article trouvé'
    ];

    if(!isset($_SESSION['user'])):
        header("Location: /");
        exit;
    else:
        if (array_key_exists('message', $_GET)) {
            $message = $messages[$_GET['message']];
        }

        if ($_POST) {
            $products = Product\delete($_POST['product_id']);

            if (!$products) {
                $message = $messages[4];

            } else {
                $message = $messages[5];
            }

        } else if ($_GET['page'] === 'lasts') {
            $products = Product\getLasts();

        } else if ($_GET['page'] === 'products') {
            $products = Product\getAll();

            if (!$products) {
                $message = $messages[6];
            }
        } else if ($_GET['page'] === 'add_cart') {
            if (array_key_exists('id', $_GET)) {
                $product_id = $_GET['id'];

                if (array_key_exists($product_id, $_SESSION['cart'])) {
                    $_SESSION['cart'][$product_id] = $_SESSION['cart'][$product_id] + 1;

                } else {
                    $_SESSION['cart'][$product_id] = 1;
                }

                $products = Product\getAll();
            }
        }
?>

<section class="ctn">
    <section class="section">
        <div class="home__subheader">
            <h1 class="title">ARO BIO HUILES</h1>
        </div>
    </section>
    <?php if ($_SESSION['user']->role === 'admin'): ?>
        <div class="form__error"><?= $message ?></div>
        <button class="form__button"><a class="link" href="index.php?page=add_product">Ajouter un article</a></button>
    <?php endif; ?>
        <ul class="products__list">
        <?php foreach ($products as $product): ?>
            <li class="products__list__card">
                <h2 class="product__title">
                    <?= $product->name ?>
                    <?php if ($_SESSION['user']->role === 'admin'): ?>
                        <form class="product__delete" method="POST" action="">
                            <input type="hidden" name="product_id" value="<?= $product->product_id ?>"/>
                            <button class="product__delete__btn" type="submit" >X</button>
                        </form>
                    <?php endif; ?>
                </h2>
                <img class="product__img" alt="<?= $product->name ?>" src="images/<?= $product->image ?>" />
                <p class="product__text"><?= $product->description ?></p>
                <p class="product__price">Prix : <span class="product__price__number"><?= $product->price ?> €</span></p>
                <?php if ($_SESSION['user']->role === 'admin'): ?>
                    <button class="form__button form__button--product">
                        <a class="link" href="index.php?page=update_product&id=<?= $product->product_id ?>">Modifier</a>
                    </button>
                <?php endif; ?>
                <button class="form__button form__button--product">
                    <a class="link" href="index.php?page=add_cart&id=<?= $product->product_id ?>&message=2">Ajouter au panier</a>
                </button>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php endif; ?>

