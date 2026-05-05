<?php
require_once '../functions/auth_check.php';
require_once '../core/autoloader.php';
use Controllers\PostController;

if (isset($_GET['id'])) {
    $controller = new PostController();
    $controller->edit($_GET['id']);
} else {
    header("Location: dashBoard.php");
    exit;
}