<?php

use Source\Dao\UsuarioDaoMysql;
use Source\Models\Usuario;
use Source\Support\Connect;

require_once '../../../vendor/autoload.php';

$name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
$email = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
$img = $_FILES['file'];

if($name && $email){
    $nome_arquivo = 'default.png';
    if(!empty($_FILES['file']['tmp_name'])) {
        $extensao = pathinfo($img['name'], PATHINFO_EXTENSION);
        $nome_arquivo = md5(time()) . ".". $extensao;
        $diretorio = "../../../source/upload/";
        ($diretorio);
        move_uploaded_file($_FILES['file']['tmp_name'], $diretorio.$nome_arquivo);
    }
    
    $pdo = Connect::getInstance();
    $usuarioDao = new UsuarioDaoMysql($pdo);
    $u = new Usuario();
    $u->setName($name);
    $u->setEmail($email);
    $u->setImg($nome_arquivo);
    $usuarioDao->add($u);

    header("Location: ".CONF_BASE_DIR); 
} else {
    header("Location: ../adicionar.php");
}