<?php
include '../db.php';
session_start();

// Check if the user is an admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "Access Denied!";
    exit();
}

// Get the user ID from the URL
if (isset($_GET['id'])) {
    $id = intval($_GET['id']);

    // Update the user's role to 'author'
    $sql = "UPDATE authors SET role = 'author' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../dashboard/authors.php?success=degraded");
        exit();
    } else {
        echo "Error degrading author: " . $conn->error;
    }
} else {
    echo "Invalid request!";
}
?>
