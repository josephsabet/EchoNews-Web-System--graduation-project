<?php
require_once '../core/autoloader.php';
use Controllers\HomeController;

$controller = new HomeController();
$controller->index();
