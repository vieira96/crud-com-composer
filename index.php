 
<?php

use Source\Dao\UsuarioDaoMysql;
use Source\Support\Connect;

require_once 'vendor/autoload.php';

$pdo = Connect::getInstance();
$usuarioDao = new UsuarioDaoMysql($pdo);
$lista = $usuarioDao->findAll();

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css">
</head>
<body>

<a class="btn btn-success" href="source/pages/adicionar.php">Adicionar</a>
<table class="table table-dark table-striped" width="100%" border="1">
    <thead>
        <tr>
            <th>IMG</th>
            <th>Id</th>
            <th>Nome</th>
            <th>Email</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($lista as $usuario): ?>
            <tr>
                <td><img width="70px" height="70px" style="border-radius: 35px;" src="<?= CONF_FILE_DIR.$usuario->getImg();?>" alt=""></td>
                <th><?= $usuario->getId();?></th>
                <td><?= $usuario->getName(); ?></td>
                <td><?= $usuario->getEmail(); ?></td>
                <td>
                    <a class="btn btn-primary" href="source/pages/editar.php?id=<?=$usuario->getId();?>">editar</a>
                    <a class="btn btn-danger" href="source/pages/excluir.php?id=<?=$usuario->getId();?>">excluir</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>

    <script src="assets/js/bootstrap.min.js"></script>
</body>
</html>