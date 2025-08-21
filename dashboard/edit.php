<?php
include '../functions/auth_check.php';
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT posts.*, categories.name AS category 
            FROM posts 
            JOIN categories ON posts.category_id = categories.id
            WHERE posts.id = $id");
    $row = $result->fetch_assoc();
}

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
    <title>Edit Article</title>
</head>

<body>
    <header id="main-header">
        <h1 class="site-title"><a href="dashBoard.php" class="nav-link">Today's News Dashboard</a></h1>
    </header>
    <main id="content">
        <section class="dashboard-section">
            <h2 class="section-title">Edit Article</h2>
            <form id="edit-article-form"  action="../functions/update.php" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <label for="article-title">Title:</label>
                <input type="text" name="title" id="article-title" value="<?php echo $row['title']; ?>" required>
                <label for="article-body">Body:</label>
                <textarea name="body" id="article-body" rows="6" required><?php echo $row['body']; ?></textarea>
                <img src="../uploads/<?php echo htmlspecialchars($row['image']); ?>" width="100" style="border: 1px solid #ccc; padding: 5px; margin-top: 20px; border-radius: 4px; box-shadow: 2px 2px 5px rgba(0,0,0,0.1);"><br>
                <input type="file" name="image" style="margin-top: 10px; margin-bottom: 15px; padding: 5px; border: 1px solid #ccc; border-radius: 4px;"><br>

                <label for="article-category">Category:</label>
                <select id="article-category" name="category_id" class="styled-select" required>
                     <option value="<?php echo $row['category_id']; ?>"><?php echo $row['category']; ?></option>

                  <?php while ($row = $categoryResult->fetch_assoc()) { ?>
                    <option value="<?php echo $row['id']; ?>">
                        <?php echo $row['name']; ?>
                    </option>
                  <?php } ?>

                </select>
    <label for="article-author" hidden>Author:</label>
    <input hidden type="text" id="article-author" name="author" value="<?php echo $_SESSION['username'] ?>">

                <button type="submit" name="update">Save</button>
            </form>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Today's News. All rights reserved.</p>
    </footer>

</body>

</html>