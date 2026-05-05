<?php include __DIR__ . '/../layouts/admin_header.php'; ?>
        <section class="dashboard-section">
            <h2 class="section-title">Pending Authors</h2>
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($pendingAuthors as $row): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['username']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['phone']); ?></td>
                        <td>
                            <button class="edit-btn"><a href="../functions/approve.php?id=<?php echo $row['id']; ?>" style="color: inherit; text-decoration: none;">Accept</a></button>
                            <button class="delet-btn"><a href="../functions/rejectpendingauthors.php?id=<?php echo $row['id']; ?>" style="color: inherit; text-decoration: none;">Reject</a></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
<?php include __DIR__ . '/../layouts/admin_footer.php'; ?>
