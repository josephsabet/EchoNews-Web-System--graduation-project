<?php
require_once '../functions/auth_check.php';
require_once '../core/autoloader.php';

use Controllers\CategoryController;

$controller = new CategoryController();

if (isset($_GET['id'])) {
    $controller->edit($_GET['id']);
} else {
    header("Location: admincategories.php");
    exit;
}

