<?php

namespace Models;

use Core\Database;

class Author {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllAuthors() {
        $result = $this->db->query("SELECT * FROM authors");
        $authors = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $authors[] = $row;
            }
        }
        return $authors;
    }

    public function getAllPendingAuthors() {
        $result = $this->db->query("SELECT * FROM pendingauthors");
        $authors = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $authors[] = $row;
            }
        }
        return $authors;
    }

    public function getPendingAuthorById($id) {
        $stmt = $this->db->prepare("SELECT * FROM pendingauthors WHERE id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createAuthor($username, $email, $password, $phone) {
        $stmt = $this->db->prepare("INSERT INTO authors (username, email, password, phone, role) VALUES (?, ?, ?, ?, 'author')");
        $stmt->bind_param("ssss", $username, $email, $password, $phone);
        return $stmt->execute();
    }

    public function deletePendingAuthor($id) {
        $stmt = $this->db->prepare("DELETE FROM pendingauthors WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function deleteAuthor($id) {
        $stmt = $this->db->prepare("DELETE FROM authors WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function updateAuthorRole($id, $role) {
        $stmt = $this->db->prepare("UPDATE authors SET role = ? WHERE id = ?");
        $stmt->bind_param("si", $role, $id);
        return $stmt->execute();
    }

    public function getAuthorByEmail($email) {
        $stmt = $this->db->prepare("SELECT * FROM authors WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createPendingAuthor($username, $email, $phone, $password) {
        $stmt = $this->db->prepare("INSERT INTO pendingauthors (username, email, phone, password) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $username, $email, $phone, $password);
        return $stmt->execute();
    }
}
