<form method="POST" action="actions/adicionar_action.php" enctype="multipart/form-data">
    <h1>Adicionar Usuário</h1>
    <label>
        Nome:<br>
        <input type="text" name="name" required>
    </label><br><br>

    <label>
        E-mail:<br>
        <input type="email" name="email" required>
    </label><br><br>
    
    <label>
        Imagem:<br>
        <input type="file" name="file">
    </label><br><br>
    <input type="submit" value="cadastrar">
    
</form>
