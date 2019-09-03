<?php
    require_once('models/product.php');

    use \Product as Product;

    if(!isset($_SESSION['user'])):
        header("Location: /");
        exit;
    else:
        if ($_GET['page'] === 'articles') {
            $products = Product\getAll();

            if (!$products) {
                $error = 'Erreur : aucun article trouvé';
            }
        } else if ($_GET['page'] === 'lasts') {
            $products = Product\getLasts();
        }
?>

<section class="ctn">
    <section class="section">
        <div class="home__subheader">
            <h1 class="title">ARO BIO HUILES</h1>
        </div>
    </section>
    <button class="form__button"><a class="link" href="index.php?page=add_article">Ajouter un article</a></button>
    <ul class="products__list">
        <?php foreach ($products as $value): ?>
            <li class="products__list__card">
                <h2 class="product__title">
                    <?= $value->name ?>
                    <form class="product__delete" method="POST" action="">
                    <input type="hidden" name="product_id" value="<?= $value->product_id ?>"/>
                    <button class="product__delete__btn" type="submit" >X</button>
                </form>
                </h2>
                <img class="product__img" alt="<?= $value->name ?>" src="images/<?= $value->image ?>" />
                <p class="product__text"><?= $value->description ?></p>
                <p class="product__price">Prix : <span class="product__price__number"><?= $value->price ?> €</span></p>
            </li>
        <?php endforeach; ?>
    </ul>
</section>

<?php endif; ?>

