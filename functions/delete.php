<?php
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Delete query
    $sql = "DELETE FROM posts WHERE id = $id";

    if ($conn->query($sql) === TRUE) {
        // Redirect back to the index page after deletion
        header("Location: ../dashboard/dashBoard.php");
        exit(); // Stop script execution
    } else {
        echo "Error deleting record: " . $conn->error;
    }
} else {
    echo "No ID provided.";
}
?>
