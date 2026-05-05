<?php
require_once '../core/autoloader.php';
use Controllers\AuthController;

$controller = new AuthController();
$controller->signup();