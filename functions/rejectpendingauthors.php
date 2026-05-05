<?php
require_once '../core/autoloader.php';
use Controllers\AuthorController;
if (isset($_GET['id'])) {
    (new AuthorController())->reject($_GET['id']);
}
