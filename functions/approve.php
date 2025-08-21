<?php
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch user details
    $sql = "SELECT * FROM pendingauthors WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();

    if ($user) {
        // Insert into authors
        $insertSql = "INSERT INTO authors (username, email, phone, password) VALUES (?, ?, ?, ?)";
        $stmt = $conn->prepare($insertSql);
        $stmt->bind_param("ssss", $user['username'], $user['email'], $user['phone'], $user['password']);
        $stmt->execute();

        // Delete from pendingauthors
        $deleteSql = "DELETE FROM pendingauthors WHERE id = ?";
        $stmt = $conn->prepare($deleteSql);
        $stmt->bind_param("i", $id);
        $stmt->execute();

        header("Location: ../dashboard/pendingauthors.php");
        exit();
    } else {
        echo "User not found.";
    }
}
?>
