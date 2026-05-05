<?php include __DIR__ . '/../layouts/admin_header.php'; ?>
        <section class="dashboard-section" style="max-width: 600px; margin: 0 auto;">
            <h2 class="section-title">Edit Category</h2>
            <form method="POST" class="admin-form">
                <div class="form-group">
                    <label for="category_name">Category Name:</label>
                    <input type="text" id="category_name" name="category_name" value="<?php echo htmlspecialchars($category['name']); ?>" required>
                </div>
                <button type="submit" name="update_category" class="auth-submit-btn">Update Category</button>
            </form>
        </section>
<?php include __DIR__ . '/../layouts/admin_footer.php'; ?>
