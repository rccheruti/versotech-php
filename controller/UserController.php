<?php

namespace controller;

use config\Connection;
use model\User;
use PDO;

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

    public function update($id, $name, $email, $colorId)
    {
        $updated = $this->user->update($id, $name, $email);
        if ($updated) {
            $this->user->setColorToUser($id, $colorId);
            return true;
        }
        return false;
    }

    public function store($nome, $email, $cor)
    {
        $userId = $this->user->create($nome, $email);
        if ($userId) {
            $this->user->addColorToUser($userId, $cor);
            return $userId;
        }
        return false;
    }

    public function delete($id)
    {
        return $this->user->delete($id);
    }

    public function getUserColors($userId)
    {
        return $this->user->getUserColors($userId);
    }

    public function addColorToUser($userId, $colorId)
    {
        return $this->user->addColorToUser($userId, $colorId);
    }

    public function removeColorFromUser($userId, $colorId)
    {
        return $this->user->removeColorFromUser($userId, $colorId);
    }
}
