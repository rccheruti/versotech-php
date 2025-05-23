<?php

namespace model;

use config\Connection;
use PDO;
class Color {
    private $conn;
    private $table = "colors";

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

    public function create($name) {
        $query = "INSERT INTO " . $this->table . " (name) VALUES (:name)";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":name", $name);

        return $stmt->execute();
    }

    public function update($id, $name) {
        $query = "UPDATE " . $this->table . " SET name = :name, WHERE id = :id";
        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":id", $id);
        $stmt->bindParam(":name", $name);

        return $stmt->execute();
    }

    public function delete($id) {
        $query = "DELETE FROM " . $this->table . " WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":id", $id);

        return $stmt->execute();
    }
}
