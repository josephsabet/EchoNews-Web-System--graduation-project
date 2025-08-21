<?php
include '../db.php';

// Fetch categories
$categoryQuery = "SELECT * FROM categories";
$categoryResult = $conn->query($categoryQuery);

$sql1 = "SELECT posts.id,posts.body, posts.title, posts.author, posts.date, posts.image, categories.name AS category
        FROM posts 
        JOIN categories ON posts.category_id = categories.id
        ORDER BY posts.date DESC LIMIT 3";

$result1 = $conn->query($sql1);

$sql2 = "SELECT posts.id,posts.body, posts.title, posts.author, posts.date, posts.image, categories.name AS category
        FROM posts 
        JOIN categories ON posts.category_id = categories.id
        ORDER BY posts.date DESC LIMIT 7";

$result2 = $conn->query($sql2);
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="../css/index.css">
    <title>Home</title>
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
        <section id="latest-news">
            <h2 class="section-title">
                <a style="text-decoration: none; color: black;">
                    Latest News
                </a>
            </h2>
           
            <?php while ($row1 = $result1->fetch_assoc()) { ?>
            <article class="news-article">
                <h3 class="article-title"><?php echo $row1['title']; ?></h3>
                <p class="article-summary"><?php echo substr($row1['body'], 0, 100) . '...'; ?></p>
                <image src="../uploads/<?php echo $row1['image']; ?>" alt="placeholder image" class="article-image">
                <a href="post.php?id=<?php echo $row1['id'] ?>" class="read-more">Read more</a>
            </article>
            <?php } ?>

        </section>
        <aside id="popular-news">
            <h2 class="section-title">
                <a style="text-decoration: none; color: black;">
                    Popular News    
                </a>
            </h2>
            <?php while ($row2 = $result2->fetch_assoc()) { ?>
            <div class="card">
                <h3 class="card-title"><?php echo $row2['title']; ?></h3>
                <p class="card-summary"><?php echo substr($row2['body'], 0, 200) . '...'; ?></p>
                <a href="post.php?id=<?php echo $row2['id'] ?>" class="read-more">Read more</a>
            </div>
            <?php } ?>

        </aside>
    </main>
    <footer id="main-footer">
        <p>&copy; 2025 News Today. All rights reserved.</p>
    </footer>
</body>

</html>

<?php $conn->close(); ?>
