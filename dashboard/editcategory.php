<?php
include '../functions/auth_check.php';
include '../db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM categories WHERE id = $id");
    $category = $result->fetch_assoc();
}

if (isset($_POST['update_category'])) {
    $name = trim($_POST['category_name']);
    if (!empty($name)) {
        $sql = "UPDATE categories SET name = ? WHERE id = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("si", $name, $id);
        if ($stmt->execute()) {
            header("Location: admincategories.php");
            exit();
        } else {
            echo "Error updating category.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Categories</title>
    <link rel="stylesheet" href="../css/admincategories.css">
</head>

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
<body>
    <div style="display: flex; justify-content: center; align-items: center; height: 80vh; width: 100%;">
        <div style="width: 100%; max-width: 600px;">
            <h2 style="text-align: center; color: #333;">Edit Category</h2>
            <form method="POST" style="display: flex; flex-direction: column; gap: 10px; width: 100%; text-align: center;">
                <input type="text" name="category_name" value="<?php echo $category['name']; ?>" required style="padding: 10px; border: 1px solid #ccc; border-radius: 5px; width: 100%;">
                <button type="submit" name="update_category" style="padding: 10px; background-color: #333; color: white; border: none; border-radius: 5px; cursor: pointer; width: 100%;">Update Category</button>
            </form>
        </div>
    </div>
</body>
</html>
