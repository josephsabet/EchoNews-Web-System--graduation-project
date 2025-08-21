<?php
include '../functions/auth_check.php';
include '../db.php'; // Database connection

// Fetch all pending authors
$sql = "SELECT * FROM authors";
$result = $conn->query($sql);


?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pending Authors</title>
    <link rel="stylesheet" href="../css/pendingAuthors.css">
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
            <h2>Pending Authors</h2>
            <table class="pending-authors-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Role</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['username'] ?></td>
                        <td><?php echo $row['email'] ?>ail</td>
                        <td><?php echo $row['phone'] ?></td>
                        <td><?php echo $row['role'] ?></td>
                        <td>
                            <button class="delete-button"><a href="../functions/regectauthors.php?id=<?php echo $row['id'] ?>" style="color: inherit; text-decoration: none;">Remove</a></button>
                            <?php if ($row['role'] === 'admin') { ?>
                                   <button class="delete-button">
                                       <a href="../functions/degradeauthor.php?id=<?php echo $row['id']; ?>" style="color: inherit; text-decoration: none;">
                                           Degrade
                                       </a>
                                   </button>
                               <?php } else { ?>
                                   <button class="accept-button">
                                       <a href="../functions/upgradeauthor.php?id=<?php echo $row['id']; ?>" style="color: inherit; text-decoration: none;">
                                           Upgrade
                                       </a>
                                   </button>
                               <?php } ?>                       
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
