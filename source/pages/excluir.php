<?php

use Source\Dao\UsuarioDaoMysql;
use Source\Support\Connect;

require_once '../../vendor/autoload.php';


$id = filter_input(INPUT_GET, 'id');
if($id) {
    $pdo = Connect::getInstance();
    $usuarioDao = new UsuarioDaoMysql($pdo);
    $usuarioDao->delete($id);
}

header("Location: ".CONF_BASE_DIR);