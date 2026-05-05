<?php

namespace Controllers;

use Models\Post;
use Models\Category;

class PageController {
    private $categoryModel;
    private $postModel;

    public function __construct() {
        $this->categoryModel = new Category();
        $this->postModel = new Post();
    }

    public function category($category_name) {
        if (!$category_name) {
            echo "No category selected!";
            exit;
        }

        $categories = $this->categoryModel->getAll();
        $posts = $this->postModel->getPostsByCategoryName($category_name);

        require_once '../views/pages/category.php';
    }

    public function post($id) {
        if (!$id) {
            echo "<h2>No post selected!</h2>";
            exit;
        }

        $categories = $this->categoryModel->getAll();
        $post = $this->postModel->getPostById($id);
        
        // Fetch latest news for the sidebar
        $latestNews = $this->postModel->getLatestPosts(4);

        if (!$post) {
            echo "<h2>Post not found!</h2>";
            exit;
        }

        require_once '../views/pages/post.php';
    }

    public function search($query) {
        $categories = $this->categoryModel->getAll();
        
        if ($query) {
            $posts = $this->postModel->searchPosts(trim($query));
        } else {
            $posts = [];
        }

        require_once '../views/pages/search.php';
    }
}
