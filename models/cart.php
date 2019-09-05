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

    function getBill($user)
    {
        global $pdo;
        $stmt = $pdo->prepare(
            "SELECT b.`bill_id`, b.`created`, b.`price` as `price_bill`, b.`adress` as `adress_ets`,
                u.`user_id`, u.`firstname`, u.`lastname`, u.`email`, u.`adress` as `adress_cli`,
                p.`name`, p.`price` as `price_product`,
                bl.`quantity`
            FROM bills_lines as bl
            LEFT JOIN bills as b ON bl.`bill_id` = b.`bill_id`
            LEFT JOIN users as u ON b.`user_id` = u.`user_id`
            LEFT JOIN products as p ON bl.`product_id` = p.`product_id`
            WHERE b.`user_id` = ?
            AND b.`bill_id` = u.`lastbill`"
        );
        $stmt->execute([$user]);
        $lines = $stmt->fetchAll(\PDO::FETCH_OBJ);

        if ($lines) {
            return $lines;
        } else {
            return false;
        }
    }

    function addBill($ids, $price, $user)
    {
        global $pdo;
        $stmt = $pdo->prepare(
            'INSERT INTO bills (`price`, `user_id`)
            VALUES (?, ?)'
        );
        $stmt->execute([$price, $user]);
        $bill_id = $pdo->lastInsertID();

        $in = str_repeat('?,', count($ids) - 1) . '?';
        $stmt = $pdo->prepare(
            "SELECT `product_id`, `price`
            FROM products
            WHERE `product_id`IN ({$in})"
        );
        $stmt->execute(array_keys($ids));
        $prices = $stmt->fetchAll(\PDO::FETCH_OBJ);

        $products = array();

        foreach ($ids as $id => $quantity) {
            foreach ($prices as $price) {
                if ($price->product_id == $id) {
                    $products[$id] = [
                        'quantity' => $quantity,
                        'price' => $price->price
                    ];
                }
            }
        }

        $lines = addLines($products, $bill_id);
    }

    function addLines($products, $bill_id)
    {
        global $pdo;
        $insert_values = array();

        foreach ($products as $id => $product) {
            $question_marks[] = '(?,' . placeholders('?', sizeof($product)) . ',?)';
            $tmpArray = array($id, $product['quantity'], $bill_id, $product['price']);
            $insert_values = array_merge($insert_values, array_values($tmpArray));
        }

        $sql = "INSERT INTO bills_lines (`product_id`, `quantity`, `bill_id`, `price`)
        VALUES " .implode(',', $question_marks);

        $stmt = $pdo->prepare($sql);
        $stmt->execute($insert_values);
    }

    function placeholders($text, $count=0, $separator=","){
        $result = array();
        if($count > 0){
            for($x=0; $x<$count; $x++){
                $result[] = $text;
            }
        }
    
        return implode($separator, $result);
    }
