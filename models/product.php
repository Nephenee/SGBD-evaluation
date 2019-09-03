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

    function getLasts()
    {
        global $pdo;
        $stmt = $pdo->query('SELECT `product_id`, `name`, `description`, `created`, `image`, `price` FROM products ORDER BY `created` DESC LIMIT 10');
        $products = $stmt->fetchAll(\PDO::FETCH_OBJ);

        if (isset($products)) {
            return $products;

        } else {
            return false;
        }
    }

    function add($name, $description, $price, ?string $image, ?string $tmp_img)
    {
        global $pdo;
        $updload = true;
        if ($image !== '') {
            $stmt = $pdo->prepare('INSERT INTO products (`name`, `description`, `image`, `price`) VALUES (?, ?, ?, ?)');
            $result = $stmt->execute([$name, $description, $image, $price]);
            $updload = move_uploaded_file($tmp_img, "images/$image");

        } else {
            $stmt = $pdo->prepare('INSERT INTO products (`name`, `description`, `price`) VALUES (?, ?, ?)');
            $result = $stmt->execute([$name, $description, $price]);
        }


        if ($result && $updload) {
            return true;

        } else {
            return false;
        }
    }

    function delete($id)
    {
        global $pdo;
        $stmt = $pdo->prepare('DELETE FROM products WHERE `product_id`=?');
        $stmt->execute([$_POST['product_id']]);
        $product = $stmt->fetch(\PDO::FETCH_OBJ);

        /*TODO: à finir */

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