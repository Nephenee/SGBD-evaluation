<?php
    require_once('models/product.php');

    use \Product as Product;

    if(!isset($_SESSION['user'])):
        header("Location: /");
        exit;
    else:
        $products = Product\getAll();

        if (!$products) {
            $error = 'Erreur : aucun article trouvé';
        }
        var_dump($products);
?>

<section class="ctn">
    <section class="section">
        <div class="home__subheader">
            <h1 class="title">ARO BIO HUILES</h1>
        </div>
    </section>
    <section class="section">
        <?php /*TODO: faire la boucle pour afficher les articles ici */ ?>
    </section>
</section>

<?php endif; ?>

