<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . '/../../core/autoloader.php';
require_once __DIR__ . '/../../core/lang.php';
?>
<!DOCTYPE html>
<html lang="<?php echo $current_lang; ?>" dir="<?php echo $current_lang === 'ar' ? 'rtl' : 'ltr'; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/news/css/global.css?v=<?php echo time(); ?>">
    <link rel="stylesheet" href="/news/css/dashBoard.css?v=<?php echo time(); ?>">
    <title>EchoNews Admin Dashboard</title>
</head>
<body class="admin-body">
    <div class="admin-layout">
        <!-- Sidebar Navigation -->
        <aside class="admin-sidebar">
            <div class="admin-brand">
                <a href="/news/pages/index.php" class="logo">Echo<span class="text-blue">News</span></a>
                <span class="admin-badge">Admin</span>
            </div>
            
            <ul class="admin-nav-list">
                <li class="admin-nav-item">
                    <a href="/news/dashboard/dashBoard.php" class="admin-nav-link">
                        <span class="nav-icon">📊</span>
                        <span class="nav-text"><?php echo __('dashboard'); ?></span>
                    </a>
                </li>
                <?php if ($_SESSION['role'] === 'admin'): ?>
                <li class="admin-nav-item">
                    <a href="/news/dashboard/admincategories.php" class="admin-nav-link">
                        <span class="nav-icon">📁</span>
                        <span class="nav-text">Categories</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="/news/dashboard/authors.php" class="admin-nav-link">
                        <span class="nav-icon">👥</span>
                        <span class="nav-text">Authors</span>
                    </a>
                </li>
                <li class="admin-nav-item">
                    <a href="/news/dashboard/pendingauthors.php" class="admin-nav-link">
                        <span class="nav-icon">⏳</span>
                        <span class="nav-text">Pending Authors</span>
                    </a>
                </li>
                <?php endif; ?>
                <li class="admin-nav-item" style="margin-top: auto;">
                    <a href="/news/functions/logout.php" class="admin-nav-link text-danger">
                        <span class="nav-icon">🚪</span>
                        <span class="nav-text"><?php echo __('logout'); ?></span>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Main Content Area -->
        <div class="admin-main-wrapper">
            <!-- Top Header -->
            <header class="admin-topbar">
                <div class="topbar-welcome">
                    Welcome back, <strong><?php echo htmlspecialchars($_SESSION['username']); ?></strong>
                </div>
                <div class="topbar-actions">
                    <a href="/news/pages/index.php" class="btn-outline">View Site</a>
                    <button id="theme-toggle" class="theme-btn">🌙</button>
                    <a href="?lang=<?php echo $current_lang === 'en' ? 'ar' : 'en'; ?>" class="lang-toggle"><?php echo $current_lang === 'en' ? 'عربي' : 'EN'; ?></a>
                </div>
            </header>
            
            <main class="admin-content-area">
