<?php

use Source\Dao\UsuarioDaoMysql;
use Source\Models\Usuario;
use Source\Support\Connect;

require_once '../../../vendor/autoload.php';

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

if($name && $email){
    
    $pdo = Connect::getInstance();
    $usuarioDao = new UsuarioDaoMysql($pdo);
    $u = new Usuario();
    $u->setName($name);
    $u->setEmail($email);
    $usuarioDao->add($u);

    header("Location: ".CONF_BASE_DIR); 
} else {
    header("Location: ../adicionar.php");
}