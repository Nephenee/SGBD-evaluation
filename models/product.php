<?php

    namespace Product;

    include_once('services/dao.php');
    use services\dao;

    function getAll()
    {
        global $pdo;
        $stmt = $pdo->query('SELECT `product_id`, `name`, `description`, `created`, `image`, `price` FROM products');
        $products = $stmt->fetchAll(\PDO::FETCH_OBJ);

        if (isset($products)) {
            return $products;

        } else {
            return false;
        }
    }

/*
    TODO: fonctions :
        créer produit si admin
        update produit si admin
        read produit si user ou admin
        delete produit si admin
    */