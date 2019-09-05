<?php

    namespace Product;

    include_once('services/dao.php');
    use services\dao;

    function getAll()
    {
        global $pdo;
        $stmt = $pdo->query(
            'SELECT `product_id`, `name`, `description`, `created`, `image`, `price`, `quantity`
            FROM products'
        );
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
        $stmt = $pdo->query(
            'SELECT `product_id`, `name`, `description`, `created`, `image`, `price`, `quantity`
            FROM products
            ORDER BY `created` DESC
            LIMIT 10'
        );
        $products = $stmt->fetchAll(\PDO::FETCH_OBJ);

        if (isset($products)) {
            return $products;

        } else {
            return false;
        }
    }

    function getOne($id)
    {
        global $pdo;
        $stmt = $pdo->prepare(
            'SELECT `product_id`, `name`, `description`, `created`, `image`, `price`, `quantity`
            FROM products
            WHERE `product_id`=?'
        );
        $stmt->execute([$id]);
        $product = $stmt->fetch(\PDO::FETCH_OBJ);

        if (isset($product)) {
            return $product;

        } else {
            return false;
        }
    }

    function add($name, $description, $price, $quantity, ?string $image, ?string $tmp_img)
    {
        global $pdo;
        $updload = true;
        if ($image !== '') {
            $stmt = $pdo->prepare(
                'INSERT INTO products (`name`, `description`, `image`, `price`, `quantity`)
                VALUES (?, ?, ?, ?, ?)'
            );
            $result = $stmt->execute([$name, $description, $image, $price, $quantity]);
            if (!file_exists("images/$image")) {
                $updload = move_uploaded_file($tmp_img, "images/$image");
            }

        } else {
            $stmt = $pdo->prepare(
                'INSERT INTO products (`name`, `description`, `price`, `quantity`)
                VALUES (?, ?, ?, ?)'
            );
            $result = $stmt->execute([$name, $description, $price, $quantity]);
        }


        if ($result && $updload) {
            return true;

        } else {
            return false;
        }
    }

    function update($id, $name, $description, $price, $quantity, ?string $image, ?string $tmp_img)
    {
        global $pdo;
        $updload = true;
        if ($image !== '') {
            $stmt = $pdo->prepare(
                'UPDATE products SET `name`=?, `description`=?, `image`=?, `price`=?, `quantity`=?
                WHERE `product_id`=?'
            );
            $result = $stmt->execute([$name, $description, $image, $price, $quantity, $id]);
            if (!file_exists("images/$image")) {
                $updload = move_uploaded_file($tmp_img, "images/$image");
            }

        } else {
            $stmt = $pdo->prepare(
                'UPDATE products SET `name`=?, `description`=?, `price`=?, `quantity`=?
                WHERE `product_id`=?'
            );
            $result = $stmt->execute([$name, $description, $price, $quantity, $id]);
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
        $stmt = $pdo->prepare(
            'DELETE FROM products
            WHERE `product_id`=?'
        );
        $delete = $stmt->execute([$_POST['product_id']]);

        if ($delete) {
            $stmt = $pdo->query(
                'SELECT `product_id`, `name`, `description`, `created`, `image`, `price`, `quantity`
                FROM products'
            );
            $products = $stmt->fetchAll(\PDO::FETCH_OBJ);

            if (isset($products)) {
                return $products;

            } else {
                return false;
            }

        } else {
            return false;
        }
    }
