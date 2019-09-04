<?php
    require_once('models/product.php');

    use \Product as Product;

    $message = '';
    $messages = ['Produit ajouté', 'Produit modifié'];

    if(!isset($_SESSION['user'])):
        header("Location: /");
        exit;
    else:
        if (array_key_exists('message', $_GET)) {
            var_dump($messages);
            $message = $messages[1];
        }

        if ($_POST) {
            $products = Product\delete($_POST['product_id']);

            if (!$products) {
                $message = 'Erreur : veuillez recommencer';

            } else {
                $message = 'Produit supprimé';
            }

        } else if ($_GET['page'] === 'lasts') {
            $products = Product\getLasts();

        } else if ($_GET['page'] === 'products') {
            $products = Product\getAll();

            if (!$products) {
                $message = 'Erreur : aucun article trouvé';
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
        <?php foreach ($products as $value): ?>
            <li class="products__list__card">
                <h2 class="product__title">
                    <?= $value->name ?>
                    <?php if ($_SESSION['user']->role === 'admin'): ?>
                        <form class="product__delete" method="POST" action="">
                            <input type="hidden" name="product_id" value="<?= $value->product_id ?>"/>
                            <button class="product__delete__btn" type="submit" >X</button>
                        </form>
                    <?php endif; ?>
                </h2>
                <img class="product__img" alt="<?= $value->name ?>" src="images/<?= $value->image ?>" />
                <p class="product__text"><?= $value->description ?></p>
                <p class="product__price">Prix : <span class="product__price__number"><?= $value->price ?> €</span></p>
                <?php if ($_SESSION['user']->role === 'admin'): ?>
                    <button class="form__button form__button--product">
                        <a class="link" href="index.php?page=update_product&id=<?= $value->product_id ?>">Modifier</a>
                    </button>
                <?php endif; ?>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php endif; ?>

