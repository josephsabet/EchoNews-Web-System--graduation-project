<?php

namespace Controllers;

use Models\Post;

class PostController {
    private $postModel;

    public function __construct() {
        $this->postModel = new Post();
    }

    public function dashboard() {
        if ($_SESSION['role'] === 'admin') {
            $posts = $this->postModel->getAllPosts();
        } else {
            $posts = $this->postModel->getPostsByAuthor($_SESSION['username']);
        }
        
        require_once '../views/posts/dashboard.php';
    }

    public function delete($id) {
        $post = $this->postModel->getPostById($id);
        if ($_SESSION['role'] !== 'admin' && $post['author'] !== $_SESSION['username']) {
            echo "You are not authorized to delete this post.";
            exit;
        }

        $this->postModel->deletePost($id);
        header("Location: ../dashboard/dashBoard.php");
        exit;
    }

    public function create() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $body = $_POST['body'];
            $author = $_SESSION['username']; // Enforce current user as author
            $category_id = $_POST['category_id'];
            $date = date("Y-m-d H:i:s");

            $image = $_FILES['image']['name'];
            $target = "../uploads/" . basename($image);
            move_uploaded_file($_FILES['image']['tmp_name'], $target);

            $this->postModel->createPost($title, $body, $author, $category_id, $date, $image);
            header("Location: ../dashboard/dashBoard.php");
            exit();
        }

        require_once '../models/Category.php';
        $categoryModel = new \Models\Category();
        $categories = $categoryModel->getAll();

        require_once '../views/posts/create.php';
    }

    public function edit($id) {
        $post = $this->postModel->getPostById($id);
        
        if ($_SESSION['role'] !== 'admin' && $post['author'] !== $_SESSION['username']) {
            echo "You are not authorized to edit this post.";
            exit;
        }

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $title = $_POST['title'];
            $body = $_POST['body'];
            $category_id = $_POST['category_id'];

            $image = null;
            if (!empty($_FILES['image']['name'])) {
                $image = $_FILES['image']['name'];
                $target = "../uploads/" . basename($image);
                move_uploaded_file($_FILES['image']['tmp_name'], $target);
            }

            $this->postModel->updatePost($id, $title, $body, $category_id, $image);
            header("Location: ../dashboard/dashBoard.php");
            exit();
        }

        require_once '../models/Category.php';
        $categoryModel = new \Models\Category();
        $categories = $categoryModel->getAll();

        require_once '../views/posts/edit.php';
    }
}
