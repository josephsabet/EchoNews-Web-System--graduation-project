<?php
require_once '../functions/auth_check.php';
require_once '../core/autoloader.php';

use Controllers\AuthorController;

$controller = new AuthorController();
$controller->pending();
