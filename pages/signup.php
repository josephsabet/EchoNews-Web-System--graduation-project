<?php
include '../db.php'; // Database connection

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Check if passwords match
    if ($password !== $confirm_password) {
        echo "<script>alert('Passwords do not match.');</script>";

    }else{
        // Hash the password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Insert user into pendingauthors table
    $sql = "INSERT INTO pendingauthors (username, email, phone, password) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $phone, $hashed_password);
    
    if ($stmt->execute()) {
        echo "<script>alert('Registration successful! You will be one of the authors after admin approves you.'); window.location.href='../pages/index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }
    }

    
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/signup.css">
    <title>Sign Up</title>
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
    <main id="content" style="width: 80%; margin: 0 auto;">
        <section class="register-section" style="width: 100%;">
            <h2 class="section-title">Create an Account</h2>
            <form id="register-form" method="POST" action="" style="width: 100%;">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required style="width: 100%;">

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required style="width: 100%;">

                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required style="width: 100%;">

                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm_password" required style="width: 100%;">

                <label for="phone">Phone Number:</label>
                <input type="tel" id="phone" name="phone" required style="width: 100%;">

                <button type="submit" name="submit" style="width: 100%;">Sign Up</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Today's News. All rights reserved.</p>
    </footer>
</body>

</html>