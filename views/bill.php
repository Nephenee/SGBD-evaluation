<?php
    require_once('models/cart.php');

    use \Cart as Cart;

    $error = '';

    if ($_GET['page'] === 'bill') {
        $bill = Cart\getBill($_SESSION['user']->user_id);

        if (!$bill) {
            $error = "Erreur : Veuillez contacter l'administrateur";
        }
    }

    if ($bill): ?>
        <section class="ctn">
            <section class="section">
                <div class="home__subheader">
                    <h1 class="title">ARO BIO HUILES</h1>
                </div>
            </section>
            <div class="bill__content">
                <div class="bill__subheader">
                    <h2 class="bill__title">Facture n° <?= $bill[0]->user_id . '-' . $bill[0]->bill_id ?></h2>
                    <h2 class="bill__text--created">créée le <?= $bill[0]->created ?></h2>

                </div>
                <div class="bill__adress__ets">
                    <h3 class="bill__adress__title">Adresse de l'entreprise</h3>
                    <p><?= $bill[0]->adress_ets ?></p>
                </div>
                <div class="bill__info-client">
                    <h3 class="bill__adress__title">Informations client</h3>
                    <p><?= $bill[0]->firstname . ' ' . $bill[0]->lastname ?></p>
                    <p>email : <?= $bill[0]->email ?></p>
                </div>
                <div class="bill__adress__client">
                    <h3 class="bill__adress__title">Adresse de facturation</h3>
                    <p><?= $bill[0]->adress_cli ?></p>
                </div>
                <div class="bill__products__ctn">
                    <ul class="bill__list">
                        <li class="bill__list__item">
                            <h3 class="bill__item__title">Produit</h3>
                            <h3 class="bill__item__title">Quantité</h3>
                            <h3 class="bill__item__title">Prix</h3>
                        </li>
                        <?php foreach ($bill as $value): ?>
                            <li class="bill__list__item">
                                <p><?= $value->name ?></p>
                                <p><?= $value->quantity ?></p>
                                <p><?= $value->price_product ?> €</p>
                            </li>
                        <?php endforeach; ?>
                    </ul>
                </div>
                <div class="bill__subfooter">
                    <h3 class="bill__title"> Total : <?= $bill[0]->price_bill ?> €</h3>
                </div>
            </div>
        </section>
<?php endif; ?>
