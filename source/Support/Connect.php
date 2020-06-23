<?php

namespace Source\Support;
use PDO;
use PDOException;

class Connect {

    private static PDO $instance;

    public static function getInstance() {
        if(empty($instance)) {
            try {
                self::$instance = new PDO(
                    "mysql:host=" . CONF_DB_HOST . ";dbname=". CONF_DB_NAME,
                    CONF_DB_USER,
                    CONF_DB_PASS
                );
            }catch(PDOException $exception) {
                die("Erro: " . $exception->getMessage()); 
            }
        }
        return self::$instance;
    }
}