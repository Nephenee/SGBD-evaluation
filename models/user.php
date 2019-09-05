<?php

    namespace User;

    include_once('services/dao.php');
    use services\dao;

    function auth($email, $password)
    {
        global $pdo;
        $stmt = $pdo->prepare(
            'SELECT `user_id`, `role_id`, `email`, `password`, `firstname`, `lastname`
            FROM users
            WHERE email=?'
        );
        $stmt->execute([$_POST['email']]);
        $user = $stmt->fetch(\PDO::FETCH_OBJ);
    
        if (isset($user) && $password === $user->password) {

            $stmt = $pdo->prepare('SELECT `role` FROM roles WHERE role_id=?');
            $stmt->execute([$user->role_id]);
            $role = $stmt->fetch(\PDO::FETCH_OBJ);

            unset($user->password);
            unset($user->role_id);
            $user->role = $role->role;
            $_SESSION['user'] = $user;
            $_SESSION['cart'] = [];
            return true;

        } else {
            return false;
        }
    }

    function add($firstname, $lastname, $email, $adress, $password)
    {
        global $pdo;
        $stmt = $pdo->prepare(
            'INSERT INTO users (`firstname`, `lastname`, `email`, `adress`, `password`)
            VALUES (?, ?, ?, ?, ?)'
        );
        $result = $stmt->execute([$firstname, $lastname, $email, $adress, $password]);

        if ($result) {
            return true;

        } else {
            return false;
        }
    }

