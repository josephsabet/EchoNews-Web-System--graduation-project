<?php

namespace Controllers;

use Models\Author;

class AuthController {
    private $authorModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->authorModel = new Author();
    }

    public function login() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $email = $_POST['email'];
            $password = $_POST['password'];

            $user = $this->authorModel->getAuthorByEmail($email);

            if ($user && password_verify($password, $user['password'])) {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['username'] = $user['username'];
                $_SESSION['role'] = $user['role'];

                header("Location: ../dashboard/dashBoard.php");
                exit();
            } else {
                $error = "Invalid credentials";
            }
        }
        
        require_once '../views/auth/login.php';
    }

    public function signup() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $password = $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password !== $confirm_password) {
                $error = "Passwords do not match.";
            } else {
                $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                $success = $this->authorModel->createPendingAuthor($username, $email, $phone, $hashed_password);
                
                if ($success) {
                    echo "<script>alert('Registration successful! You will be one of the authors after admin approves you.'); window.location.href='../pages/index.php';</script>";
                    exit();
                } else {
                    $error = "Error registering.";
                }
            }
        }
        
        require_once '../views/auth/signup.php';
    }

    public function logout() {
        session_destroy();
        header("Location: ../pages/index.php");
        exit();
    }
}
