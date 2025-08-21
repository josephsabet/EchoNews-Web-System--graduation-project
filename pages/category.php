<?php
include '../db.php'; // Include database connection

$categoryQuery = "SELECT * FROM categories";
$categoryResult = $conn->query($categoryQuery);


if (isset($_GET['category'])) {
    $category_name = $_GET['category']; // Get the category name from the URL

    // Fetch category ID by category name
    $categoryQuery = "SELECT id FROM categories WHERE name = ?";
    $stmt = $conn->prepare($categoryQuery);
    $stmt->bind_param("s", $category_name);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $category = $result->fetch_assoc();
        $category_id = $category['id']; // Get the category ID
    } else {
        echo "Category not found!";
        exit();
    }

    // Fetch posts based on category ID
    $sql = "SELECT * FROM posts WHERE category_id = ? ORDER BY date DESC";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $category_id);
    $stmt->execute();
    $posts = $stmt->get_result();

} else {
    echo "No category selected!";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/posts.css">
    <title>Posts by  <?php echo htmlspecialchars($category_name); ?></title>
</head>

<body>
<header id="main-header">
        <div class="container">
            <h1 class="site-title"><a href="index.php" class="nav-link">Today's News</a></h1>
            <nav class="main-nav">
            <ul class="nav-list">
                    <li class="nav-item"><a href="login.php" class="nav-link">Login</a></li>
                    <?php while ($row = $categoryResult->fetch_assoc()) { ?>
            <li class="nav-item"><a href="category.php?category=<?php echo $row['name']; ?>" class="nav-link"><?php echo $row['name']; ?></a></li>
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
        <section class="posts-section">
            <h2 class="section-title">Posts by <?php echo htmlspecialchars($category_name); ?></h2>
            <div class="posts-grid">
 
            <?php if ($posts->num_rows > 0) {  
                while ($row = $posts->fetch_assoc()) { ?>
                <div class="post-card">
                    <h2 class="post-title"><?php echo $row['title']; ?></h2>
                    <img src="../uploads/<?php echo $row['image']; ?>" alt="Post Image" class="post-image">
                    <p class="post-excerpt"><?php echo substr($row['body'], 0, 100) . '...'; ?></p>
                    <a href="post.php?id=<?php echo $row['id'] ?>" class="read-more">Read More</a>
                </div>
                
                <?php } ?>

                <?php } else{?>
                    <h2 style="text-align: center; color: red;">No posts found in this category.</h2>
                <?php } ?>

            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Today's News. All rights reserved.</p>
    </footer>

</body>

</html>