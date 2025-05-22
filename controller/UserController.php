<?php

namespace controller;

use config\Connection;
use PDO;

class UserController
{
    private PDO $connection;

    public function __construct()
    {
        $connection = new Connection();
        $this->connection = $connection->getConnection();
    }

    public function getUsers()
    {
        return $this->connection->query("SELECT * FROM users");
    }

}