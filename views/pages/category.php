<?php include __DIR__ . '/../layouts/header.php'; ?>
        <section class="posts-section">
            <h2 class="section-title">Posts by <?php echo htmlspecialchars($category_name); ?></h2>
            <div class="posts-grid">
                <?php if (count($posts) > 0): ?>
                    <?php foreach ($posts as $post): ?>
                    <div class="post-card">
                        <div class="article-image-wrapper">
                            <img src="../uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="Post Image" class="post-image">
                        </div>
                        <div class="article-content">
                            <h2 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h2>
                            <p class="post-excerpt"><?php echo htmlspecialchars(substr($post['body'], 0, 100)) . '...'; ?></p>
                            <a href="post.php?id=<?php echo $post['id']; ?>" class="read-more">Read More</a>
                        </div>
                    </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <h2 style="text-align: center; color: red;">No posts found in this category.</h2>
                <?php endif; ?>
            </div>
        </section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
