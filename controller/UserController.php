<?php

namespace controller;

use config\Connection;
use model\User;

class UserController
{
    private $user;

    public function __construct()
    {
        $connection = new Connection();
        $db = $connection->getConnection();
        $this->user = new User($db);
    }

    public function getUsers()
    {
        return $this->user->getAll();
    }

    public function edit($id)
    {
        return $this->user->getById($id);
    }

    public function update($id, $nome, $email, $cor)
    {
        return $this->user->update($id, $nome, $email, $cor);
    }

    public function store($nome, $email, $cor)
    {
        return $this->user->create($nome, $email, $cor);
    }

    public function delete($id)
    {
        return $this->user->delete($id);
    }
}
