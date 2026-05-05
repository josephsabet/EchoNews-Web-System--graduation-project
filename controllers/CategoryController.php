<?php

namespace Controllers;

use Models\Category;

class CategoryController {
    private $categoryModel;

    public function __construct() {
        $this->categoryModel = new Category();
    }

    // Handle listing and creating categories (for the admin categories page)
    public function index() {
        // Handle category creation
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_category'])) {
            $name = trim($_POST['category_name']);
            if (!empty($name)) {
                $this->categoryModel->create($name);
                // Redirect to avoid form resubmission
                header("Location: admincategories.php");
                exit;
            } else {
                $error = "Category name cannot be empty!";
            }
        }

        // Fetch all categories to pass to the view
        $categories = $this->categoryModel->getAll();

        // Load the view
        require_once '../views/categories/index.php';
    }

    // Handle editing a category
    public function edit($id) {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['update_category'])) {
            $name = trim($_POST['category_name']);
            if (!empty($name)) {
                $this->categoryModel->update($id, $name);
                header("Location: admincategories.php");
                exit;
            }
        }

        $category = $this->categoryModel->getById($id);
        require_once '../views/categories/edit.php';
    }

    // Handle deleting a category
    public function delete($id) {
        $this->categoryModel->delete($id);
        header("Location: admincategories.php");
        exit;
    }
}
