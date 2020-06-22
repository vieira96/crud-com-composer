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
        $sql = $this->pdo->prepare("INSERT INTO usuarios (name, email) VALUES (:name, :email)");
        $sql->bindValue(':name', $u->getName());
        $sql->bindValue(':email', $u->getEmail());
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

            return $u;
        }
    }
    public function findByEmail($email){

    }

    public function update(Usuario $u){

        $sql = $this->pdo->prepare("UPDATE usuarios SET name = :name, email = :email WHERE id = :id");
        $sql->bindValue(":name", $u->getName());
        $sql->bindValue(":email", $u->getEmail());
        $sql->bindValue(":id", $u->getId());
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