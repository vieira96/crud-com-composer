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
    $img = $_FILES['file'];

    if($name && $email && $id){
        
        $pdo = Connect::getInstance();
        $usuarioDao = new UsuarioDaoMysql($pdo);
        $u = new Usuario();
        $u->setName($name);
        $u->setEmail($email);
        $u->setId($id);
        $u->setImg($usuario->getImg());
        if(!empty($_FILES['file']['tmp_name'])) {
            if($usuario->getImg() != 'default.png'){
                unlink("../../../source/upload/".$usuario->getImg());
            }
            $extensao = pathinfo($img['name'], PATHINFO_EXTENSION);
            $nome_arquivo = md5(time()) . ".". $extensao;
            $diretorio = "../../../source/upload/";
            move_uploaded_file($_FILES['file']['tmp_name'], $diretorio.$nome_arquivo);
            $u->setImg($nome_arquivo);
        }

        $usuarioDao->update($u);
        header("Location: ".CONF_BASE_DIR); 
    } else {
        header("Location: ../editar.php?id=".$usuario->getId());
    }
}else{
    header("Location: ".CONF_BASE_DIR); 
}