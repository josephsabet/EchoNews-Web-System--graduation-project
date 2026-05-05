<?php
require_once '../core/autoloader.php';
use Controllers\AuthorController;
if (isset($_GET['id'])) {
    (new AuthorController())->remove($_GET['id']);
}
