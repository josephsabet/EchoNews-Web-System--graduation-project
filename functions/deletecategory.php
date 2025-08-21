<?php
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete category
    $sql = "DELETE FROM categories WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: ../dashboard/admincategories.php");
        exit();
    } else {
        echo "Error deleting category.";
    }
}
?>
