<?php

namespace Controllers;

use Models\Author;

class AuthorController {
    private $authorModel;

    public function __construct() {
        $this->authorModel = new Author();
    }

    // Display all active authors
    public function index() {
        $authors = $this->authorModel->getAllAuthors();
        require_once '../views/authors/index.php';
    }

    // Display all pending authors
    public function pending() {
        $pendingAuthors = $this->authorModel->getAllPendingAuthors();
        require_once '../views/authors/pending.php';
    }

    // Approve a pending author
    public function approve($id) {
        $pending = $this->authorModel->getPendingAuthorById($id);
        if ($pending) {
            $this->authorModel->createAuthor($pending['username'], $pending['email'], $pending['password'], $pending['phone']);
            $this->authorModel->deletePendingAuthor($id);
        }
        header("Location: ../dashboard/pendingauthors.php");
        exit;
    }

    // Reject a pending author
    public function reject($id) {
        $this->authorModel->deletePendingAuthor($id);
        header("Location: ../dashboard/pendingauthors.php");
        exit;
    }

    // Remove an active author
    public function remove($id) {
        $this->authorModel->deleteAuthor($id);
        header("Location: ../dashboard/authors.php");
        exit;
    }

    // Upgrade author to admin
    public function upgrade($id) {
        $this->authorModel->updateAuthorRole($id, 'admin');
        header("Location: ../dashboard/authors.php");
        exit;
    }

    // Degrade admin to author
    public function degrade($id) {
        $this->authorModel->updateAuthorRole($id, 'author');
        header("Location: ../dashboard/authors.php");
        exit;
    }
}
