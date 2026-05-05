<?php
require_once '../functions/auth_check.php';
require_once '../core/autoloader.php';

use Controllers\PostController;

$controller = new PostController();
$controller->dashboard();