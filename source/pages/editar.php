<?php 

    use Source\Dao\UsuarioDaoMysql;
    use Source\Support\Connect;

    require_once '../../vendor/autoload.php';


    $id = filter_input(INPUT_GET, 'id');

    if($id){
        $pdo = Connect::getInstance();
        $usuarioDao = new UsuarioDaoMysql($pdo);
        $usuario = $usuarioDao->findById($id);
    }

?>
<form method="POST" action="actions/editar_action.php?id=<?=$usuario->getId();?>">
    <h1>Editando Usuário <?= $usuario->getName();?></h1>
    <label>
        Nome:<br>
        <input type="text" name="name" value="<?=$usuario->getName();?>">
    </label><br><br>

    <label>
        E-mail:<br>
        <input type="email" name="email" value="<?= $usuario->getEmail(); ?>">
    </label><br><br>
    <input type="submit" value="Atualizar">

</form>