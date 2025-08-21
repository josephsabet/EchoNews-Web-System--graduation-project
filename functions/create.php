<?php
include '../db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $title = $_POST['title'];
    $body = $_POST['body'];
    $author = $_POST['author'];
    $category_id = $_POST['category_id'];
    $date = date("Y-m-d H:i:s");

    // Image upload handling
    $image = $_FILES['image']['name'];
    $target = "../uploads/" . basename($image);
    move_uploaded_file($_FILES['image']['tmp_name'], $target);

    $sql = "INSERT INTO posts (title, body, author, category_id, date, image) 
            VALUES ('$title', '$body', '$author', '$category_id', '$date', '$image')";

    if ($conn->query($sql) === TRUE) {
        // Redirect to index.php with a success message
        header("Location: ../dashboard/dashBoard.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
