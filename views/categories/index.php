<?php include __DIR__ . '/../layouts/admin_header.php'; ?>
        <section class="dashboard-section">
            <h2 class="section-title">Categories</h2>
            
            <?php if (isset($error)): ?>
                <p style="color: red;"><?php echo htmlspecialchars($error); ?></p>
            <?php endif; ?>

            <form method="POST" class="admin-form" style="display: flex; gap: 15px; margin-bottom: 30px; align-items: flex-end;">
                 <div class="form-group" style="flex: 1; margin: 0;">
                     <label for="category_name" style="display: none;">New Category Name</label>
                     <input type="text" id="category_name" name="category_name" placeholder="Enter New Category Name" required>
                 </div>
                 <button type="submit" name="add_category" class="auth-submit-btn" style="margin: 0; max-width: 200px;">Add Category</button>
            </form>
            <table class="dashboard-table">
                <thead>
                    <tr>
                        <th>Category Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($categories as $category): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($category['name']); ?></td>
                        <td>
                            <button class="edit-btn"><a href="editcategory.php?id=<?php echo $category['id']; ?>" class="action-link" style="color: inherit; text-decoration: none;">Edit</a></button>
                            <!-- Changed delete link to point to a controller action or keeping it as is temporarily -->
                            <button class="delet-btn"><a href="../functions/deletecategory.php?id=<?php echo $category['id']; ?>" class="action-link" style="color: inherit; text-decoration: none;">Delete</a></button>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </section>
<?php include __DIR__ . '/../layouts/admin_footer.php'; ?>
