<?php

    namespace Cart;

    include_once('services/dao.php');
    use services\dao;

    function getAll($ids)
    {
        global $pdo;
        $products = [];

        foreach ($ids as $id) {
            $stmt = $pdo->prepare('SELECT `product_id`, `name`, `description`, `created`, `image`, `price` FROM products WHERE `product_id`=?');
            $stmt->execute([$id]);
            $product = $stmt->fetch(\PDO::FETCH_OBJ);
    
            if (isset($products)) {
                array_push($products, $product);
            }
        }

        return $products;
    }