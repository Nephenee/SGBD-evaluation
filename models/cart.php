<?php

    namespace Cart;

    include_once('services/dao.php');
    use services\dao;

    function getAll($ids)
    {
        global $pdo;
        $in = str_repeat('?,', count($ids) - 1) . '?';
        $stmt = $pdo->prepare(
            "SELECT `product_id`, `name`, `description`, `created`, `image`, `price`
            FROM products
            WHERE `product_id`IN ({$in})"
        );
        $stmt->execute(array_keys($ids));
        $products = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return $products;
    }