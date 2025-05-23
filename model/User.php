<?php

namespace model;

use config\Connection;
use PDO;
class User {
    private $conn;
    private $table = "users";

    public function __construct($db) {
        $this->conn = $db;
    }

    public function getAll() {
        $query = "SELECT * FROM " . $this->table;
        $stmt = $this->conn->prepare($query);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $query = "SELECT * FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($nome, $email, $cor) {
        $query = "INSERT INTO " . $this->table . " (nome, email, cor) VALUES (:nome, :email, :cor)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":cor", $cor);

        return $stmt->execute();
    }

    public function update($id, $nome, $email, $cor) {
        $query = "UPDATE " . $this->table . " SET nome = :nome, email = :email, cor = :cor WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":nome", $nome);
        $stmt->bindParam(":email", $email);
        $stmt->bindParam(":cor", $cor);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }

    
    public function getUserColors($userId) {
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

    public function addColorToUser($userId, $colorId) {
        $query = "INSERT INTO user_colors (user_id, color_id) VALUES (:user_id, :color_id)";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':color_id', $colorId);
    
        return $stmt->execute();
    }

    public function removeColorFromUser($userId, $colorId) {
        $query = "DELETE FROM user_colors WHERE user_id = :user_id AND color_id = :color_id";
    
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':color_id', $colorId);
    
        return $stmt->execute();
    }

}
