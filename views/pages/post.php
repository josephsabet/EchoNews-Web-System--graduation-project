<?php include __DIR__ . '/../layouts/header.php'; ?>
        <div class="post-layout-container">
            <article class="single-post-main">
                <div class="post-category-tag"><?php echo htmlspecialchars(translate_api($post['category'])); ?></div>
                <h1 class="post-title"><?php echo htmlspecialchars(translate_api($post['title'])); ?></h1>
                
                <div class="post-meta-line">
                    By <span class="author-name"><?php echo htmlspecialchars($post['author']); ?></span>
                    <span class="meta-dot">•</span>
                    <time datetime="<?php echo htmlspecialchars($post['date']); ?>"><?php echo date('M j, Y', strtotime($post['date'])); ?></time>
                    <span class="meta-dot">•</span>
                    <span class="read-time"><?php echo max(1, round(str_word_count($post['body']) / 200)); ?> min read</span>
                </div>

                <div class="main-image-container">
                    <img src="../uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="News image" class="post-image">
                    <div class="image-caption"><?php echo htmlspecialchars(translate_api($post['title'])); ?>. (Photo: EchoNews)</div>
                </div>

                <div class="post-content">
                    <?php 
                        // Simulate the bold dateline at the start of the article
                        $body = htmlspecialchars(translate_api($post['body']));
                        // Add a fake location and date if none exists, just to match the visual!
                        $location = mb_strtoupper(translate_api('Global'));
                        $date_str = date('M j');
                        echo "<p><strong>{$location}, {$date_str} — </strong>" . nl2br($body) . "</p>"; 
                    ?>
                </div>

                <ul class="tags-list">
                    <li class="tag-item"><a href="category.php?category=<?php echo urlencode($post['category']); ?>" class="tag-link"><?php echo htmlspecialchars(translate_api($post['category'])); ?></a></li>
                </ul>
            </article>

            <aside class="single-post-sidebar">
                <h3 class="sidebar-title"><?php echo __('latest_news'); ?></h3>
                <div class="sidebar-news-list">
                    <?php foreach ($latestNews as $sidePost): ?>
                    <a href="post.php?id=<?php echo $sidePost['id']; ?>" class="sidebar-news-item">
                        <img src="../uploads/<?php echo htmlspecialchars($sidePost['image']); ?>" alt="Thumbnail">
                        <div class="sidebar-news-content">
                            <h4><?php echo htmlspecialchars(translate_api($sidePost['title'])); ?></h4>
                            <time><?php echo date('M j, Y', strtotime($sidePost['date'])); ?></time>
                        </div>
                    </a>
                    <?php endforeach; ?>
                </div>
            </aside>
        </div>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
