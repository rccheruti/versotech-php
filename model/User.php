<?php

namespace model;

use config\Connection;
use PDO;

class User
{
    private $conn;
    private $table = "users";

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAll()
    {
        $query = "SELECT u.id, u.name, u.email, c.id as color_id, c.name as color_name
                  FROM " . $this->table . " u
                  LEFT JOIN user_colors uc ON u.id = uc.user_id
                  LEFT JOIN colors c ON uc.color_id = c.id";

        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id)
    {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($name, $email)
    {
        $query = "INSERT INTO " . $this->table . " (name, email) VALUES (:name, :email)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);

        if ($stmt->execute()) {
            return $this->conn->lastInsertId();
        }
        return false;
    }

    public function update($id, $name, $email)
    {
        $query = "UPDATE " . $this->table . " SET name = :name, email = :email WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);
        $stmt->bindParam(":email", $email);

        return $stmt->execute();
    }

    public function delete($id)
    {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }


    public function getUserColors($userId)
    {
        $query = "
            SELECT c.id, c.name 
            FROM colors c
            INNER JOIN user_colors uc ON c.id = uc.color_id
            WHERE uc.user_id = :user_id
        ";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addColorToUser($userId, $colorId)
    {
        $query = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':color_id', $colorId);

        return $stmt->execute();
    }

    public function removeColorFromUser($userId, $colorId)
    {
        $query = "DELETE FROM user_colors WHERE user_id = :user_id AND color_id = :color_id";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':color_id', $colorId);

        return $stmt->execute();
    }  

    public function setColorToUser($userId, $colorId)
    {
        $queryDelete = "DELETE FROM user_colors WHERE user_id = :user_id";
        $stmtDelete = $this->conn->prepare($queryDelete);
        $stmtDelete->bindParam(':user_id', $userId);
        $stmtDelete->execute();

        $queryInsert = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";
        $stmtInsert = $this->conn->prepare($queryInsert);
        $stmtInsert->bindParam(':user_id', $userId);
        $stmtInsert->bindParam(':color_id', $colorId);
        return $stmtInsert->execute();
    }
}
