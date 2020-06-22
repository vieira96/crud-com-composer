<?php

namespace Source\Models;

interface UsuarioDAO {
    public function add(Usuario $u);
    public function findAll();
    public function findById($id);
    public function findByEmail($email);
    public function update(Usuario $u);
    public function delete($id);
}