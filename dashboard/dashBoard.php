<?php
include '../functions/auth_check.php';
include '../db.php';

if ($_SESSION['role'] === 'admin') {
$sql = "SELECT posts.id,posts.body, posts.title, posts.author, posts.date, posts.image, categories.name AS category
        FROM posts 
        JOIN categories ON posts.category_id = categories.id
        ORDER BY posts.date DESC";
}else{
    $sql = "SELECT posts.id,posts.body, posts.title, posts.author, posts.date, posts.image, categories.name AS category
    FROM posts 
    JOIN categories ON posts.category_id = categories.id
    WHERE posts.author = '".$_SESSION['username']."'
    ORDER BY posts.date DESC";
}

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/dashBoard.css">
    <title>Dashboard</title>
</head>

<body>
    <header id="main-header" style="background-color: #333; color: white; padding: 10px 0; text-align: center;">
        <h1 class="site-title"><a href="dashBoard.php" class="nav-link" style="color: white; text-decoration: none;">Today's News Dashboard</a></h1>
        <nav>
            <ul style="list-style: none; padding: 0; display: flex; justify-content: center; gap: 20px;">
            <li><a href="../pages/index.php" class="nav-link" style="color: white; text-decoration: none;">Home</a></li>
            <li><a href="../functions/logout.php" class="nav-link" style="color: white; text-decoration: none;">Logout</a></li>
            <?php if ($_SESSION['role'] === 'admin') { ?>
        <li><a href="admincategories.php" class="nav-link" style="color: white; text-decoration: none;">Categories</a></li>
        <li><a href="authors.php" class="nav-link" style="color: white; text-decoration: none;">Authors</a></li>
        <li><a href="pendingauthors.php" class="nav-link" style="color: white; text-decoration: none;">Pending Authors</a></li>
    <?php } ?>
            </ul>
        </nav>
    </header>
    <main id="content">
        <section class="dashboard-section">
            <h2 class="section-title">Manage posts as <?php echo $_SESSION['username'] ?></h2>
            <button id="add-article-btn"><a style="color: white;" href="./insert.php">Add post</a></button>
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Author</th>
                        <th>Date</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody id="article-table-body">
                    <?php
                    $i = 1;                   
                    while($row = $result->fetch_assoc()){
                    ?>
                    <tr>
                        <td><?php echo $i ?></td>
                        <td><?php echo $row['title'] ?></td>
                        <td><?php echo $row['author'] ?></td>
                        <td><?php echo $row['date'] ?></td>
                        <td>
                            <button class="edit-btn"><a style="color: #333; "
                                    href="edit.php?id=<?php echo $row['id'] ?>">Edit</a></button>
                                    <button class="delet-btn"><a style="color: #333; "
                                    href="../functions/delete.php?id=<?php echo $row['id'] ?>">Delete</a></button>
                        </td>
                    </tr>
                    
                    <?php
                     $i = $i+1; 
                     }?>
                </tbody>

            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 Today's News. All rights reserved.</p>
    </footer>



</body>

</html>