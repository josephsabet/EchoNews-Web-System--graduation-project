<?php

namespace Models;

use Core\Database;

class Category {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    // Get all categories
    public function getAll() {
        $result = $this->db->query("SELECT * FROM categories");
        $categories = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $categories[] = $row;
            }
        }
        return $categories;
    }

    // Get a single category by ID
    public function getById($id) {
        $stmt = $this->db->prepare("SELECT * FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    // Create a new category
    public function create($name) {
        $stmt = $this->db->prepare("INSERT INTO categories (name) VALUES (?)");
        $stmt->bind_param("s", $name);
        return $stmt->execute();
    }

    // Update a category
    public function update($id, $name) {
        $stmt = $this->db->prepare("UPDATE categories SET name = ? WHERE id = ?");
        $stmt->bind_param("si", $name, $id);
        return $stmt->execute();
    }

    // Delete a category
    public function delete($id) {
        $stmt = $this->db->prepare("DELETE FROM categories WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }
}
