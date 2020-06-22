<?php

use Source\Dao\UsuarioDaoMysql;
use Source\Support\Connect;

require_once 'vendor/autoload.php';

$pdo = Connect::getInstance();
$usuarioDao = new UsuarioDaoMysql($pdo);
$lista = $usuarioDao->findAll();

?>

<a href="source/pages/adicionar.php">Adicionar</a>
<table width="100%" border="1">
    <tr>
        <th>Id</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Ações</th>
    </tr>
    <?php foreach($lista as $usuario): ?>
    <tr>
        <th><?= $usuario->getId();?></th>
        <td><?= $usuario->getName(); ?></td>
        <td><?= $usuario->getEmail(); ?></td>
        <td>
            <a href="source/pages/editar.php?id=<?=$usuario->getId();?>">[ editar ]</a>
            <a href="source/pages/excluir.php?id=<?=$usuario->getId();?>">[ excluir ]  </a>
        </td>
    </tr>
    <?php endforeach; ?>
</table>