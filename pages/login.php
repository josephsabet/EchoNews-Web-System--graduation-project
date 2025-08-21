<?php
session_start();
include '../db.php'; // Database connection

// Fetch categories
$categoryQuery = "SELECT * FROM categories";
$categoryResult = $conn->query($categoryQuery);


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM authors WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role']; // Store role (admin or author)

        // Redirect to dashboard after login
        header("Location: ../dashboard/dashboard.php");
        exit();
    } else {
        echo "<script>alert('Invalid credentials');</script>";

    }
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/login.css">
    <title>Login</title>
</head>

<body>
    <header id="main-header">
        <div class="container">
            <h1 class="site-title"><a href="index.php" class="nav-link">Today's News</a></h1>
        </div>
    </header>
    <style>
        .nav-link {
            color: inherit; /* Remove blue color */
        }
    </style>
    <main id="content">
        <section class="login-section">
            <h2 class="section-title">Please Login</h2>
            <form id="login-form" method="post">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
                <button type="submit">Login</button>
                <p>Don't have an account? <a href="signup.php">Sign up</a></p>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Today's News. All rights reserved.</p>
    </footer>
</body>

</html>