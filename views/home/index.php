<?php include __DIR__ . '/../layouts/header.php'; ?>
        <section id="latest-news">
            <h2 class="section-title"><a><?php echo __('latest_news'); ?></a></h2>
            <div class="latest-news-grid">
                <?php foreach ($latestNews as $post): ?>
                <article class="news-article">
                    <div class="article-image-wrapper">
                        <img src="../uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="News Image" class="article-image">
                    </div>
                    <div class="article-content">
                        <h3 class="article-title"><?php echo htmlspecialchars(translate_api($post['title'])); ?></h3>
                        <p class="article-summary"><?php echo htmlspecialchars(translate_api(substr($post['body'], 0, 100) . '...')); ?></p>
                        <a href="post.php?id=<?php echo $post['id']; ?>" class="read-more"><?php echo __('read_more'); ?></a>
                    </div>
                </article>
                <?php endforeach; ?>
            </div>
        </section>
        <aside id="popular-news">
            <h2 class="section-title"><a><?php echo __('popular_news'); ?></a></h2>
            <div class="popular-news-list">
                <div class="slider-track">
                    <?php 
                    // Output the items twice to create a seamless infinite scrolling effect!
                    for($i = 0; $i < 2; $i++): 
                        $rank = 1; 
                        foreach ($popularNews as $post): 
                    ?>
                    <a href="post.php?id=<?php echo $post['id']; ?>" class="popular-card-link">
                        <div class="card popular-card">
                            <span class="popular-rank"><?php echo $rank++; ?></span>
                            <div class="popular-img-wrapper">
                                <img src="../uploads/<?php echo htmlspecialchars($post['image']); ?>" alt="News" class="popular-img">
                            </div>
                            <div class="popular-content">
                                <h3 class="card-title"><?php echo htmlspecialchars(translate_api($post['title'])); ?></h3>
                                <span class="read-more-text"><?php echo __('read_more'); ?></span>
                            </div>
                        </div>
                    </a>
                    <?php 
                        endforeach; 
                    endfor; 
                    ?>
                </div>
            </div>
        </aside>
<?php include __DIR__ . '/../layouts/footer.php'; ?>
