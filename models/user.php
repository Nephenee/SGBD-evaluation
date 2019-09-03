<?php

    namespace User;

    include_once('services/dao.php');
    use services\dao;

    function auth($email, $password)
    {
        global $pdo;
        $stmt = $pdo->prepare('SELECT `user_id`, `role_id`, `email`, `password`, `firstname`, `lastname` FROM users WHERE email = ?');
        $stmt->execute([$_POST['email']]);
        $user = $stmt->fetch(\PDO::FETCH_OBJ);
    
        if (isset($user) && $password === $user->password) {
            unset($user->password);
            $_SESSION['user'] = $user;
            return true;

        } else {
            return false;
        }
    }

