<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Check if the user is an author and is trying to access restricted pages
if ($_SESSION['role'] === 'author') {
    // List of restricted pages for authors
    $restricted_pages = ['admincategories.php', 'authors.php','edit.php','editcategory.php','insert.php','pendingauthors.php'];

    // Get the current page name
    $current_page = basename($_SERVER['PHP_SELF']);

    // If the user is an author and they try to access a restricted page
    if (in_array($current_page, $restricted_pages)) {
        header("Location: dashBoard.php"); // Redirect to author's dashboard
        exit();
    }
}

// You can add more role checks or any other logic here if needed.
?>
