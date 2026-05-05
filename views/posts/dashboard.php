<?php include __DIR__ . '/../layouts/admin_header.php'; ?>
        <section class="dashboard-section">
            <h2 class="section-title">Manage News as <?php echo htmlspecialchars($_SESSION['username']); ?></h2>
            <button id="add-article-btn"><a style="color: white; text-decoration: none;" href="insert.php">Add News</a></button>
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
                    <?php $i = 1; foreach ($posts as $row): ?>
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td><?php echo htmlspecialchars($row['title']); ?></td>
                        <td><?php echo htmlspecialchars($row['author']); ?></td>
                        <td><?php echo htmlspecialchars($row['date']); ?></td>
                        <td>
                            <button class="edit-btn"><a style="color: #333; text-decoration: none;" href="edit.php?id=<?php echo $row['id']; ?>">Edit</a></button>
                            <button class="delet-btn"><a style="color: #333; text-decoration: none;" href="../functions/delete.php?id=<?php echo $row['id']; ?>">Delete</a></button>
                        </td>
                    </tr>
                    <?php $i++; endforeach; ?>
                </tbody>
            </table>
        </section>
<?php include __DIR__ . '/../layouts/admin_footer.php'; ?>
