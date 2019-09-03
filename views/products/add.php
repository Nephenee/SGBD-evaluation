<?php
    require_once('models/product.php');

    use \Product as Product;

    $error = '';

    if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']->role !== 'admin')):
        header("Location: /");
        exit;
    else:
        if ($_GET['page'] === 'add_article' && $_POST) {
            $product = Product\add($_POST['name'], $_POST['description'], $_POST['price'], $_FILES['image']['name'], $_FILES['image']['tmp_name']);

            if ($product) {
                header("Location: /index.php?page=articles");
                exit;
            } else {
                $error = 'Erreur : Veuillez recommencer.';
            }

        } else if ($_GET['page'] === 'update_article') {
            $products = Product\getLasts();
        }
?>

<section class="ctn">
    <section class="section">
        <h2 class="subtitle subtitle--connect">Ajouter un produit</h2>
        <div class="form__error"><?= $error ?></div>
        <form class="form" method="POST" enctype="multipart/form-data" action="">
            <input class="form__input" type="text" name="name" placeholder="Nom du produit" />
            <input class="form__input" type="text" name="description" placeholder="Description" />
            <input class="form__input--file" type="file" name="image" id="image" />
            <label for="image" class="form__input form__input--label">Choisir un fichier</label>
            <input class="form__input" type="number" step=".01" name="price" placeholder="0.00" />
            <button class="form__button" type="submit">Valider</button>
        </form>
    </section>
</section>

<?php endif; ?>