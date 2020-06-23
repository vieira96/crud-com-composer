<?php

namespace Source\Dao;

use Source\Models\UsuarioDAO;
use Source\Models\Usuario;
use PDO;

class UsuarioDaoMysql implements UsuarioDAO {

    private $pdo;

    public function __construct(PDO $driver)
    {
        $this->pdo = $driver;
    }

    public function add(Usuario $u){
        $sql = $this->pdo->prepare("INSERT INTO usuarios (name, email, img) VALUES (:name, :email, :img)");
        $sql->bindValue(':name', $u->getName());
        $sql->bindValue(':email', $u->getEmail());
        $sql->bindValue(":img", $u->getImg());
        $sql->execute();
    }
    
    public function findAll(){
        $array = [];

        $sql = $this->pdo->query("SELECT * FROM usuarios");
        if($sql->rowCount() > 0) {
            $data = $sql->fetchAll();
            foreach($data as $usuario) {
                $u = new Usuario();
                $u->setId($usuario['id']);
                $u->setName($usuario['name']);
                $u->setEmail($usuario['email']);
                $u->setImg($usuario['img']);
                $array[] = $u;
            }
        }

        return $array;
    }
    public function findById($id){
        $sql = $this->pdo->prepare("SELECT * FROM usuarios WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        if($sql->rowCount() > 0 ) {
            $user = $sql->fetch();
            $u = new Usuario();
            $u->setId($user['id']);
            $u->setName($user['name']);
            $u->setEmail($user['email']);
            $u->setImg($user['img']);
            return $u;
        }else{
            header("Location: ".CONF_BASE_DIR);
            exit;
        }
    }
    public function findByEmail($email){

    }

    public function update(Usuario $u){

        $sql = $this->pdo->prepare("UPDATE usuarios SET name = :name, email = :email, img = :img WHERE id = :id");
        $sql->bindValue(":name", $u->getName());
        $sql->bindValue(":email", $u->getEmail());
        $sql->bindValue(":id", $u->getId());
        $sql->bindValue(":img", $u->getImg());
        $sql->execute();

        return true;
    }

    public function delete($id){
        $sql = $this->pdo->prepare("DELETE FROM usuarios WHERE id = :id");
        $sql->bindValue('id', $id);
        $sql->execute();
        return true;
    }

}