<?php
    namespace services\dao;

    // pdo local sur boutique
    $db_dsn  = "mysql:dbname=evaluation;host=localhost;charset=utf8";
    $db_username = "root";
    $db_password = "0000";

    try {
        $pdo = new \PDO(
            $db_dsn,
            $db_username,
            $db_password,
            array(\PDO::MYSQL_ATTR_INIT_COMMAND => 'SET lc_time_names = \'fr_FR\''));
        $pdo->exec('SET NAMES utf8');
        $pdo->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

    } catch (PDOException $e) {
        echo 'Connexion échouée : ' . $e->getMessage();
    }
