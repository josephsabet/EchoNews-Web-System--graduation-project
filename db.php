<?php
$host = "localhost";
$user = "root";  // Change if necessary
$pass = "123";      // Add password if set
$dbname = "news";

$conn = new mysqli($host, $user, $pass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
