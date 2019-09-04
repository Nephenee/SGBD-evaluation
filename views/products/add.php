<?php
    require_once('models/product.php');

    use \Product as Product;

    $error = '';

    if(!isset($_SESSION['user']) || (isset($_SESSION['user']) && $_SESSION['user']->role !== 'admin')):
        header("Location: /");
        exit;
    else:
        if ($_GET['page'] === 'add_product' && $_POST) {
            $product = Product\add($_POST['name'], $_POST['description'], $_POST['price'], $_FILES['image']['name'], $_FILES['image']['tmp_name']);

            if ($product) {
                header("Location: /index.php?page=products&message=0");
                exit;
            } else {
                $error = 'Erreur : Veuillez recommencer';
            }

        } else if ($_GET['page'] === 'update_product') {
            if (array_key_exists('id', $_GET)) {
                $product = Product\getOne($_GET['id']);

                if($_POST) {
                    $product = Product\update($_POST['product_id'], $_POST['name'], $_POST['description'], $_POST['price'], $_FILES['image']['name'], $_FILES['image']['tmp_name']);

                    if ($product) {
                        header("Location: /index.php?page=products&message=1");
                        exit;
                    } else {
                        $error = 'Erreur : Veuillez recommencer';
                    }
                }

            } else {
                $error = "Erreur : le produit n'existe pas";
            }

        }
?>

<section class="ctn">
    <section class="section">
        <h2 class="subtitle subtitle--connect">Ajouter un produit</h2>
        <div class="form__error"><?= $error ?></div>
        <?php if($_GET['page'] === 'add_product'): ?>
        <form class="form" method="POST" enctype="multipart/form-data" action="">
            <input class="form__input" type="text" name="name" placeholder="Nom du produit" />
            <textarea class="form__input form__input--area" name="description" placeholder="Description (optionnel)" ></textarea>
            <input class="form__input--file" type="file" name="image" id="image" />
            <label for="image" class="form__input form__input--label">Choisir un fichier (optionnel)</label>
            <input class="form__input" type="number" step=".01" name="price" placeholder="0.00" />
            <button class="form__button" type="submit">Valider</button>
        </form>
        <?php else: ?>
            <form class="form" method="POST" enctype="multipart/form-data" action="">
                <input type="hidden" name="product_id" value=<?= $product->product_id ?> />
                <input class="form__input" type="text" name="name" value="<?= $product->name ?>" />
                <textarea class="form__input form__input--area" name="description" placeholder="Description (optionnel)" ><?= $product->description ?></textarea>
                <input class="form__input--file" type="file" name="image" id="image" />
                <label for="image" class="form__input form__input--label">Choisir un fichier (optionnel)</label>
                <input class="form__input" type="number" step=".01" name="price" value="<?= $product->price ?>" />
                <button class="form__button" type="submit">Modifier</button>
            </form>
        <?php endif; ?>
    </section>
</section>

<?php endif; ?>