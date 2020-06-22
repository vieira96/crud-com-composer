<?php

use Source\Dao\UsuarioDaoMysql;
use Source\Models\Usuario;
use Source\Support\Connect;

require_once '../../../vendor/autoload.php';

$id = filter_input(INPUT_GET, 'id');

if($id) {
    $pdo = Connect::getInstance();
    $usuarioDao = new UsuarioDaoMysql($pdo);
    $usuario = $usuarioDao->findById($id);
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
    $email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);

    if($name && $email){
        $pdo = Connect::getInstance();
        $usuarioDao = new UsuarioDaoMysql($pdo);
        $u = new Usuario();
        $u->setName($name);
        $u->setEmail($email);
        $u->setId($id);
        $usuarioDao->update($u);

        header("Location: ".CONF_BASE_DIR); 
    } else {
        header("Location: ../editar.php?id=".$usuario->getId());
    }
}else{
    header("Location: ".CONF_BASE_DIR); 
}