<?php

namespace controller;

use config\Connection;
use PDO;
class ColorController
{
    private PDO $connection;

    public function __construct()
    {
        $connection = new Connection();
        $this->connection = $connection->getConnection();
    }

    public function getAllColors()
    {
        return $this->connection->query("SELECT * FROM colors");
    }

}