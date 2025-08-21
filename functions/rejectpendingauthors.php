<?php
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    
    $sql = "DELETE FROM pendingauthors WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    
    if ($stmt->execute()) {
        header("Location: ../dashboard/pendingauthors.php");
        exit();
    } else {
        echo "Error rejecting user.";
    }
}
?>
