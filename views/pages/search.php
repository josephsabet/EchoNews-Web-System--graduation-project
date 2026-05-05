<?php include __DIR__ . '/../layouts/header.php'; ?>
        <section class="posts-section">
            <h2 class="section-title">Posts related to <?php echo htmlspecialchars($query ?? ''); ?></h2>
            <div class="posts-grid">
            <?php if (count($posts) > 0): ?>
                <?php foreach ($posts as $post): ?>
                <div class="post-card">
                    <h2 class="post-title"><?php echo htmlspecialchars($post['title']); ?></h2>
                    <img src="../uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="Post Image" class="post-image">
                    <p class="post-excerpt"><?php echo htmlspecialchars(substr($post['body'], 0, 100)) . '...'; ?></p>
                    <a href="../pages/post.php?id=<?php echo $post['id']; ?>" class="read-more">Read More</a>
                </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p>No results found for '<strong><?php echo htmlspecialchars($query ?? ''); ?></strong>'</p>
            <?php endif; ?>
            </div>
        </section>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
