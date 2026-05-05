<?php

namespace Controllers;

use Models\Post;
use Models\Category;

class HomeController {
    public function index() {
        $categoryModel = new Category();
        $categories = $categoryModel->getAll();

        $postModel = new Post();
        $latestNews = $postModel->getLatestPosts(3);
        $popularNews = $postModel->getLatestPosts(7); // They were identical logic in original code

        require_once '../views/home/index.php';
    }
}
