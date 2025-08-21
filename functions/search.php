<?php
include '../db.php'; // Include your database connection

// Fetch categories for the navigation menu
$categorySql = "SELECT name FROM categories";
$categoryResult = $conn->query($categorySql);

if (isset($_GET['query'])) {
    $search = trim($_GET['query']); // Remove extra spaces
    $search = "%$search%"; // Add wildcards for partial matching
    $searchh = str_replace("%", "", $search);
    // Query to search in title, author, and body
    $sql = "SELECT * FROM posts WHERE title LIKE ? OR author LIKE ? OR body LIKE ? ORDER BY date DESC";
    
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $search, $search, $search);
    $stmt->execute();
    $result = $stmt->get_result();

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/posts.css">
    <title>Posts by Category</title>
</head>

<body>
<header id="main-header">
        <div class="container">
            <h1 class="site-title"><a href="../pages/index.php" class="nav-link">Today's News</a></h1>
            <nav class="main-nav">
            <ul class="nav-list">
                    <li class="nav-item"><a href="../pages/login.php" class="nav-link">Login</a></li>
                    <?php while ($row = $categoryResult->fetch_assoc()) { ?>
            <li class="nav-item"><a href="../pages/category.php?category=<?php echo $row['name']; ?>" class="nav-link"><?php echo $row['name']; ?></a></li>
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
            <h2 class="section-title">Posts related to <?php echo $searchh ?> </h2>
            <div class="posts-grid">
            <?php
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
       ?>

                <div class="post-card">
                    <h2 class="post-title"><?php echo $row['title'] ?></h2>
                    <img src="../uploads/<?php echo $row['image']; ?>" alt="Post Image" class="post-image">
                    <p class="post-excerpt"><?php echo substr($row['body'], 0, 100) . '...'; ?></p>
                    <a href="../pages/post.php?id=<?php echo $row['id'] ?>" class="read-more">Read More</a>
                </div>


                <?php 
                }
    } else {
        echo "<p>No results found for '<strong>" . htmlspecialchars($_GET['query']) . "</strong>'</p>";
    }
}
?>
            </div>
        </section>
    </main>
    <footer>
        <p>&copy; 2023 Today's News. All rights reserved.</p>
    </footer>

</body>

</html>