<?php
require_once '../core/autoloader.php';
use Controllers\PageController;

$controller = new PageController();
if (isset($_GET['category'])) {
    $controller->category($_GET['category']);
} else {
    $controller->category(null);
}