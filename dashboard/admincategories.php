<?php
require_once '../functions/auth_check.php';

require_once '../core/autoloader.php';

use Controllers\CategoryController;

// Initialize the controller
$controller = new CategoryController();

// Call the index method which handles logic and loads the view
$controller->index();