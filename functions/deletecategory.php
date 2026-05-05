<?php
require_once '../core/autoloader.php';

use Controllers\CategoryController;

if (isset($_GET['id'])) {
    $controller = new CategoryController();
    $controller->delete($_GET['id']);
} else {
    header("Location: ../dashboard/admincategories.php");
    exit();
}

