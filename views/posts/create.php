<?php include __DIR__ . '/../layouts/admin_header.php'; ?>
        <section class="dashboard-section" style="max-width: 800px; margin: 0 auto;">
            <h2 class="section-title">Create News Post</h2>
            
            <form id="edit-article-form" action="" method="POST" enctype="multipart/form-data" class="admin-form">
                <div class="form-group">
                    <label for="article-title">Title:</label>
                    <input type="text" id="article-title" name="title" required>
                </div>
                
                <div class="form-group">
                    <label for="article-body">Body:</label>
                    <textarea id="article-body" name="body" rows="15" required style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid var(--border-color);"></textarea>
                </div>

                <div class="form-group" style="display: flex; gap: 20px;">
                    <div style="flex: 1;">
                        <label for="article-category">Category:</label>
                        <select id="article-category" name="category_id" class="styled-select" required style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid var(--border-color);">
                            <option value="">Select Category</option>
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>"><?php echo htmlspecialchars($cat['name']); ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div style="flex: 1;">
                        <label for="article-image">Upload Cover Image:</label>
                        <input type="file" id="article-image" name="image" accept="image/*" required style="padding: 10px 0;">
                    </div>
                </div>

                <input hidden type="text" id="article-author" name="author" value="<?php echo htmlspecialchars($_SESSION['username']); ?>">
                <button type="submit" name="submit" class="auth-submit-btn" style="margin-top: 20px; max-width: 200px;">Publish News</button>
            </form>
        </section>
<?php include __DIR__ . '/../layouts/admin_footer.php'; ?>
