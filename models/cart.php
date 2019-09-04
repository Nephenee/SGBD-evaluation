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

    function addBill($ids, $price, $user)
    {
        global $pdo;
        $stmt = $pdo->prepare(
            'INSERT INTO bill_lines (`price`, `user_id`)
            VALUES (?, ?)'
        );
        $stmt->execute([$price, $user]);
        $bill = $stmt->fetch(\PDO::FETCH_OBJ);
        var_dump($bill);die;
        $products = getAll($ids);
        var_dump($products);die;
        /* mettre requête dans tableau? */
        foreach ($products as $product) {
            addLine($product->product_id, $ids[$product->product_id], $bill->bill_id, $product->price);
        }
    }

    function addLine($product_id, $quantity, $bill_id, $price)
    {
        global $pdo;
        $stmt = $pdo->prepare(
            'INSERT INTO bill_lines (`product_id`, `quantity`, `bill_id`, `price`)
            VALUES (?, ?, ?, ?)'
        );
        $stmt->execute([$product_id, $quantity, $bill_id, $price]);
        $lines = $stmt->fetchAll(\PDO::FETCH_OBJ);

        var_dump($lines);die;
    }
