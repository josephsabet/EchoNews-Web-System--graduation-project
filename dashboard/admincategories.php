<?php
include '../functions/auth_check.php';
include '../db.php'; // Database connection

// // Handle category addition
if (isset($_POST['add_category'])) {
    $name = trim($_POST['category_name']);
    if (!empty($name)) {
        $sql = "INSERT INTO categories (name) VALUES (?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $name);
        if ($stmt->execute()) {
            // echo "Category added successfully!";
        } else {
            echo "Error: " . $stmt->error;
        }
    } else {
        echo "Category name cannot be empty!";
    }
}

// Fetch all categories
$categories = $conn->query("SELECT * FROM categories");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Categories</title>
    <link rel="stylesheet" href="../css/admincategories.css">
</head>

<body>
    <header id="main-header" style="background-color: #333; color: white; padding: 10px 0; text-align: center;">
        <h1 class="site-title"><a href="dashBoard.php" class="nav-link" style="color: white; text-decoration: none;">Today's News Dashboard</a></h1>
        <nav>
            <ul style="list-style: none; padding: 0; display: flex; justify-content: center; gap: 20px;">
            <li><a href="../pages/index.php" class="nav-link" style="color: white; text-decoration: none;">Home</a></li>
            <li><a href="../functions/logout.php" class="nav-link" style="color: white; text-decoration: none;">Logout</a></li>
                <li><a href="admincategories.php" class="nav-link" style="color: white; text-decoration: none;">Categories</a></li>
                <li><a href="authors.php" class="nav-link" style="color: white; text-decoration: none;">Authors</a></li>
                <li><a href="pendingauthors.php" class="nav-link" style="color: white; text-decoration: none;">Pending Authors</a></li>
            </ul>
        </nav>
    </header>
    <main>
        <section>
            <h2>Categories</h2>
            <form method="POST" style="margin-bottom: 20px;">
                 <input type="text" name="category_name" placeholder="New Category Name" required style="padding: 5px; margin-right: 10px;">
                 <button type="submit" name="add_category" style="padding: 5px 10px; background-color: #333; color: white; border: none; cursor: pointer;">Add Category</button>
            </form>
            <table class="categories-table">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                <?php while ($row = $categories->fetch_assoc()) { ?>

                    <tr>
                        <td><?php echo $row['name']; ?></td>
                        <td>
                            <a href="editcategory.php?id=<?php echo $row['id']; ?>" class="action-link">Edit</a> |
                            <a href="../functions/deletecategory.php?id=<?php echo $row['id']; ?>" class="action-link">Delete</a>
                        </td>
                    </tr>
                    <?php } ?>

                </tbody>
            </table>
        </section>
    </main>
    <footer>
        <p>&copy; 2025 News Website. All rights reserved.</p>
    </footer>
</body>

</html>