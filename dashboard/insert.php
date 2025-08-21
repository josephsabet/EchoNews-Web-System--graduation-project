<?php
include '../functions/auth_check.php';
include '../db.php';

// Fetch categories
$categoryQuery = "SELECT * FROM categories";
$categoryResult = $conn->query($categoryQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/edit.css">
    <title>create Article</title>
</head>

<body>
    <header id="main-header">
        <h1 class="site-title"><a href="dashBoard.php" class="nav-link">Today's News Dashboard</a></h1>
    </header>
    <main id="content">
        <section class="dashboard-section">
            <h2 class="section-title">create Article</h2>
            
            <form id="edit-article-form" action="../functions/create.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="article-id" name="id">
                <label for="article-title">Title:</label>
                <input type="text" id="article-title" name="title" required>
                <label for="article-body">Body:</label>
                <textarea id="article-body" name="body" rows="10" required></textarea>
                <label for="article-image">Upload Image:</label>
                <input type="file" id="article-image" name="image" accept="image/*" required>
                <label for="article-category">Category:</label>
                <select id="article-category" name="category_id" class="styled-select" required>
                <option value="">Select Category</option>

        <?php while ($row = $categoryResult->fetch_assoc()) { ?>
            <option value="<?php echo $row['id']; ?>"><?php echo $row['name']; ?></option>
        <?php } ?>

                </select>
                <label for="article-author" hidden>Author:</label>
                <input hidden type="text" id="article-author" name="author" value="<?php echo $_SESSION['username'] ?>">
                <button type="submit" name="submit">Save</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Today's News. All rights reserved.</p>
    </footer>

</body>

</html>