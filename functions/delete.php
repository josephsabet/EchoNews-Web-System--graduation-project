<?php
require_once '../core/autoloader.php';
use Controllers\PostController;

if (isset($_GET['id'])) {
    (new PostController())->delete($_GET['id']);
} else {
    echo "No ID provided.";
}
