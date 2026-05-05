<?php
require_once '../core/autoloader.php';
use Controllers\PageController;

$controller = new PageController();
if (isset($_GET['id'])) {
    $controller->post($_GET['id']);
} else {
    $controller->post(null);
}
