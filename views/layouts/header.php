<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../core/autoloader.php';
require_once __DIR__ . '/../../core/lang.php';
$categoryModel = new \Models\Category();
$navCategories = $categoryModel->getAll();
?>
<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>" dir="<?php echo $current_lang === 'ar' ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/news/css/global.css?v=<?php echo time(); ?>">
    <?php 
    $currentPage = basename($_SERVER['SCRIPT_NAME']);
    if ($currentPage === 'index.php' && strpos($_SERVER['REQUEST_URI'], 'dashboard') === false) {
        echo '<link rel="stylesheet" href="/news/css/index.css?v=' . time() . '">';
    } elseif ($currentPage === 'category.php' || $currentPage === 'search.php') {
        echo '<link rel="stylesheet" href="/news/css/posts.css?v=' . time() . '">';
    } elseif ($currentPage === 'post.php') {
        echo '<link rel="stylesheet" href="/news/css/post.css?v=' . time() . '">';
    } else {
        // Load dashboard styles for admin pages
        echo '<link rel="stylesheet" href="/news/css/dashBoard.css?v=' . time() . '">';
    }
    ?>
    <title>EchoNews</title>
</head>
<body>
    <header class="echo-header">
        <div class="top-bar">
            <div class="container top-bar-inner">
                <span class="date-text"><?php echo date('l, F j, Y'); ?></span>
                <div class="user-actions">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <span class="top-welcome"><?php echo __('welcome'); ?>, <?php echo htmlspecialchars($_SESSION['username']); ?></span>
                        <a href="/news/dashboard/dashBoard.php" class="top-link"><?php echo __('dashboard'); ?></a>
                        <a href="/news/functions/logout.php" class="top-link"><?php echo __('logout'); ?></a>
                    <?php else: ?>
                        <a href="/news/pages/login.php" class="top-link"><?php echo __('journalist_login'); ?></a>
                        <a href="/news/pages/signup.php" class="top-link"><?php echo __('apply_journalist'); ?></a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <div class="main-header">
            <div class="container header-inner">
                <div class="logo-container">
                    <a href="/news/pages/index.php" class="logo">Echo<span class="text-blue">News</span></a>
                </div>
                <div class="search-container" style="display: flex; align-items: center; gap: 15px;">
                    <form action="/news/functions/search.php" method="GET" class="search-form">
                        <input type="text" name="query" placeholder="<?php echo __('search_placeholder'); ?>" class="search-input" required>
                        <button type="submit" class="search-button"><?php echo __('search_btn'); ?></button>
                    </form>
                    <a href="?lang=<?php echo $current_lang === 'en' ? 'ar' : 'en'; ?>" class="lang-toggle" style="background: transparent; border: 1px solid var(--border-color); color: var(--text-main); font-weight: 600; text-decoration: none; padding: 6px 12px; border-radius: 6px; transition: all 0.3s ease;">
                        <?php echo $current_lang === 'en' ? 'عربي' : 'EN'; ?>
                    </a>
                    <button id="theme-toggle" class="theme-btn" aria-label="Toggle Dark Mode" style="background: transparent; border: 1px solid var(--border-color); color: var(--text-main); font-size: 18px; cursor: pointer; padding: 6px 12px; border-radius: 6px; transition: all 0.3s ease;">🌙</button>
                </div>
            </div>
        </div>
        
        <script>
            // Theme Toggle Logic
            const themeToggle = document.getElementById('theme-toggle');
            const rootElement = document.documentElement;
            
            // Check for saved theme or system preference
            const savedTheme = localStorage.getItem('theme');
            if (savedTheme) {
                rootElement.setAttribute('data-theme', savedTheme);
                if(savedTheme === 'dark') themeToggle.textContent = '☀️';
            } else if (window.matchMedia && window.matchMedia('(prefers-color-scheme: dark)').matches) {
                rootElement.setAttribute('data-theme', 'dark');
                themeToggle.textContent = '☀️';
            }

            themeToggle.addEventListener('click', () => {
                const currentTheme = rootElement.getAttribute('data-theme');
                if (currentTheme === 'dark') {
                    rootElement.setAttribute('data-theme', 'light');
                    localStorage.setItem('theme', 'light');
                    themeToggle.textContent = '🌙';
                } else {
                    rootElement.setAttribute('data-theme', 'dark');
                    localStorage.setItem('theme', 'dark');
                    themeToggle.textContent = '☀️';
                }
            });
        </script>
        <nav class="main-nav">
            <div class="container">
                <ul class="nav-list">
                    <li class="nav-item"><a href="/news/pages/index.php" class="nav-link"><?php echo __('home'); ?></a></li>
                    <?php foreach ($navCategories as $cat): ?>
                        <li class="nav-item"><a href="/news/pages/category.php?category=<?php echo urlencode($cat['name']); ?>" class="nav-link"><?php echo htmlspecialchars(translate_api($cat['name'])); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </nav>
        
        <?php if (isset($_SESSION['user_id']) && strpos($_SERVER['REQUEST_URI'], 'dashboard') !== false): ?>
        <nav class="admin-nav" style="background-color: var(--bg-light); border-bottom: 1px solid var(--border-color); padding: 10px 0;">
            <div class="container">
                <ul class="nav-list" style="justify-content: center; gap: 20px; font-size: 14px;">
                    <li class="nav-item"><a href="/news/dashboard/dashBoard.php" class="nav-link" style="color: var(--primary-blue);"><?php echo __('dashboard'); ?></a></li>
                    <?php if ($_SESSION['role'] === 'admin'): ?>
                        <li class="nav-item"><a href="/news/dashboard/admincategories.php" class="nav-link" style="color: var(--text-main);">Categories</a></li>
                        <li class="nav-item"><a href="/news/dashboard/authors.php" class="nav-link" style="color: var(--text-main);">Authors</a></li>
                        <li class="nav-item"><a href="/news/dashboard/pendingauthors.php" class="nav-link" style="color: var(--text-main);">Pending Authors</a></li>
                    <?php endif; ?>
                </ul>
            </div>
        </nav>
        <?php endif; ?>
    </header>
    <main id="content" class="container">
