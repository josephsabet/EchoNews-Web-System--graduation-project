<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /news/pages/login.php"); // Absolute path redirect
    exit();
}

// Check if the user is an author and is trying to access restricted pages
if ($_SESSION['role'] === 'author') {
    // List of restricted pages for authors
    $restricted_pages = ['admincategories.php', 'authors.php','editcategory.php','pendingauthors.php'];

    // Get the current page name
    $current_page = basename($_SERVER['PHP_SELF']);

    // If the user is an author and they try to access a restricted page
    if (in_array($current_page, $restricted_pages)) {
        header("Location: /news/dashboard/dashBoard.php"); // Absolute path redirect
        exit();
    }
}
?>
