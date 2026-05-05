<?php include __DIR__ . '/../layouts/admin_header.php'; ?>
        <section class="dashboard-section">
            <h2 class="section-title">Authors</h2>
            <table class="dashboard-table">
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
                    <?php foreach ($authors as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td><?php echo htmlspecialchars($row['role']); ?></td>
                        <td>
                            <button class="delet-btn"><a href="../functions/regectauthors.php?id=<?php echo $row['id']; ?>" style="color: inherit; text-decoration: none;">Remove</a></button>
                            <?php if ($row['role'] === 'admin'): ?>
                                <button class="delet-btn">
                                    <a href="../functions/degradeauthor.php?id=<?php echo $row['id']; ?>" style="color: inherit; text-decoration: none;">Degrade</a>
                                </button>
                            <?php else: ?>
                                <button class="edit-btn">
                                    <a href="../functions/upgradeauthor.php?id=<?php echo $row['id']; ?>" style="color: inherit; text-decoration: none;">Upgrade</a>
                                </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
<?php include __DIR__ . '/../layouts/admin_footer.php'; ?>
