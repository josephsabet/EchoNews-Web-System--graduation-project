<?php

namespace Models;

use Core\Database;

class Post {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function getAllPosts() {
        $sql = "SELECT posts.id, posts.body, posts.title, posts.author, posts.date, posts.image, categories.name AS category
                FROM posts 
                JOIN categories ON posts.category_id = categories.id
                ORDER BY posts.date DESC";
        $result = $this->db->query($sql);
        $posts = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }
        return $posts;
    }

    public function getPostsByAuthor($username) {
        $sql = "SELECT posts.id, posts.body, posts.title, posts.author, posts.date, posts.image, categories.name AS category
                FROM posts 
                JOIN categories ON posts.category_id = categories.id
                WHERE posts.author = ?
                ORDER BY posts.date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $result = $stmt->get_result();
        $posts = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }
        return $posts;
    }

    public function deletePost($id) {
        $stmt = $this->db->prepare("DELETE FROM posts WHERE id = ?");
        $stmt->bind_param("i", $id);
        return $stmt->execute();
    }

    public function getPostById($id) {
        $stmt = $this->db->prepare("SELECT posts.*, categories.name AS category 
                                    FROM posts 
                                    JOIN categories ON posts.category_id = categories.id 
                                    WHERE posts.id = ?");
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function createPost($title, $body, $author, $category_id, $date, $image) {
        $stmt = $this->db->prepare("INSERT INTO posts (title, body, author, category_id, date, image) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssiss", $title, $body, $author, $category_id, $date, $image);
        return $stmt->execute();
    }

    public function updatePost($id, $title, $body, $category_id, $image = null) {
        if ($image) {
            $stmt = $this->db->prepare("UPDATE posts SET title = ?, body = ?, category_id = ?, image = ? WHERE id = ?");
            $stmt->bind_param("ssisi", $title, $body, $category_id, $image, $id);
        } else {
            $stmt = $this->db->prepare("UPDATE posts SET title = ?, body = ?, category_id = ? WHERE id = ?");
            $stmt->bind_param("ssii", $title, $body, $category_id, $id);
        }
        return $stmt->execute();
    }

    public function getLatestPosts($limit) {
        $sql = "SELECT posts.id, posts.body, posts.title, posts.author, posts.date, posts.image, categories.name AS category
                FROM posts 
                JOIN categories ON posts.category_id = categories.id
                ORDER BY posts.date DESC LIMIT ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("i", $limit);
        $stmt->execute();
        $result = $stmt->get_result();
        $posts = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }
        return $posts;
    }

    public function getPostsByCategoryName($category_name) {
        $sql = "SELECT posts.*, categories.name AS category 
                FROM posts 
                JOIN categories ON posts.category_id = categories.id 
                WHERE categories.name = ? 
                ORDER BY posts.date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("s", $category_name);
        $stmt->execute();
        $result = $stmt->get_result();
        $posts = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }
        return $posts;
    }

    public function searchPosts($query) {
        $search = "%" . $query . "%";
        $sql = "SELECT * FROM posts WHERE title LIKE ? OR author LIKE ? OR body LIKE ? ORDER BY date DESC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param("sss", $search, $search, $search);
        $stmt->execute();
        $result = $stmt->get_result();
        $posts = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $posts[] = $row;
            }
        }
        return $posts;
    }
}
