<?php
require_once '../core/autoloader.php';
use Controllers\PageController;

$controller = new PageController();
if (isset($_GET['query'])) {
    $controller->search($_GET['query']);
} else {
    $controller->search('');
}