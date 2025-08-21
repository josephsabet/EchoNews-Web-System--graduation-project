<?php
include '../db.php'; // Connect to the database

$categoryQuery = "SELECT * FROM categories";
$categoryResult = $conn->query($categoryQuery);

// Check if 'id' is provided in the URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Fetch the specific post using JOIN to get category name
    $sql = "SELECT posts.*, categories.name AS category 
            FROM posts 
            JOIN categories ON posts.category_id = categories.id
            WHERE posts.id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<h2>Post not found!</h2>";
        exit;
    }
} else {
    echo "<h2>No post selected!</h2>";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/post.css">
    <title><?php echo $row['title']; ?></title>
</head>

<body>
<header id="main-header">
        <div class="container">
            <h1 class="site-title"><a href="index.php" class="nav-link">Today's News</a></h1>
            <nav class="main-nav">
            <ul class="nav-list">
                    <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
        <?php while ($categoryRow = $categoryResult->fetch_assoc()) { ?>
        <li class="nav-item"><a href="category.php?category=<?php echo $categoryRow['name']; ?>" class="nav-link"><?php echo $categoryRow['name']; ?></a></li>
        <?php } ?>

                </ul>
            </nav>
            <div class="search-container" style="display: flex; align-items: center; justify-content: center; margin-top: 10px;">
                <form action="../functions/search.php" method="GET" style="display: flex;">
                    <input type="text" name="query" placeholder="Search..." class="search-input" style="padding: 5px; border: 1px solid #ccc; border-radius: 4px;">
                    <button type="submit" class="search-button" style="padding: 5px 10px; border: none; background-color: #333; color: white; border-radius: 4px; margin-left: 5px; cursor: pointer;">Search</button>
                </form>
            </div>
        </div>
    </header>
    <main id="content">
        <article class="single-post">
            <h2 class="post-title"><?php echo $row['title']; ?></h2>
            <p class="post-meta">Posted on <time datetime="2023-10-01"><?php echo $row['date']; ?></time> by <?php echo $row['author']; ?></p>
            <img src="../uploads/<?php echo $row['image']; ?>" alt="placeholder image" class="post-image">
            <p class="post-content"><?php echo $row['body']; ?></p>
            <ul class="tags-list">
                <li class="tag-item"><a href="category.php?category=<?php echo $row['category']; ?>" class="tag-link"><?php echo $row['category']; ?></a></li>
            </ul>
        </article>

    </main>
    <footer>
        <p>&copy; 2025 Today's News. All rights reserved.</p>
    </footer>
</body>

</html>
<?php $conn->close(); ?>
