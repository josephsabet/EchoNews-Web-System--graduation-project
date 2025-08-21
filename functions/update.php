<?php
include '../db.php';

if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $category_id = $_POST['category_id'];
    $body = $_POST['body'];

    // Handle Image Upload
    if ($_FILES['image']['name']) {
        $image = $_FILES['image']['name'];
        $target = "../uploads/" . basename($image);
        move_uploaded_file($_FILES['image']['tmp_name'], $target);
        $sql = "UPDATE posts SET title='$title', author='$author', category_id='$category_id', image='$image', body='$body' WHERE id=$id";
    } else {
        $sql = "UPDATE posts SET title='$title', author='$author', category_id='$category_id', body='$body' WHERE id=$id";
    }

    if ($conn->query($sql) === TRUE) {
        echo "News updated successfully.";
        header("Location: ../dashboard/dashBoard.php");

    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
