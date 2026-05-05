<?php include __DIR__ . '/../layouts/admin_header.php'; ?>
        <section class="dashboard-section" style="max-width: 800px; margin: 0 auto;">
            <h2 class="section-title">Edit News Post</h2>
            <form id="edit-article-form" action="" method="POST" enctype="multipart/form-data" class="admin-form">
                <div class="form-group">
                    <label for="article-title">Title:</label>
                    <input type="text" name="title" id="article-title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                </div>
                
                <div class="form-group">
                    <label for="article-body">Body:</label>
                    <textarea name="body" id="article-body" rows="15" required style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid var(--border-color);"><?php echo htmlspecialchars($post['body']); ?></textarea>
                </div>
                
                <div class="form-group" style="display: flex; gap: 20px;">
                    <div style="flex: 1;">
                        <label for="article-category">Category:</label>
                        <select id="article-category" name="category_id" class="styled-select" required style="width: 100%; padding: 12px; border-radius: 6px; border: 1px solid var(--border-color);">
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?php echo $cat['id']; ?>" <?php echo $post['category_id'] == $cat['id'] ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($cat['name']); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    
                    <div style="flex: 1;">
                        <label for="article-image">Current Cover Image:</label>
                        <?php if ($post['image']): ?>
                            <img src="../uploads/<?php echo htmlspecialchars($post['image']); ?>" style="width: 120px; object-fit: cover; border-radius: 4px; border: 1px solid var(--border-color); margin-bottom: 10px; display: block;">
                        <?php endif; ?>
                        <input type="file" name="image" style="padding: 10px 0;">
                    </div>
                </div>

                <button type="submit" name="update" class="auth-submit-btn" style="margin-top: 20px; max-width: 200px;">Save News</button>
            </form>
        </section>
<?php include __DIR__ . '/../layouts/admin_footer.php'; ?>
