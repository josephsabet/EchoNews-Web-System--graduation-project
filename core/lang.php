<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

if (isset($_GET['lang']) && in_array($_GET['lang'], ['en', 'ar'])) {
    $_SESSION['lang'] = $_GET['lang'];
}

$current_lang = $_SESSION['lang'] ?? 'en';

function __($key) {
    static $translations = null;
    if ($translations === null) {
        $translations = [
            'en' => [
                'latest_news' => 'Latest News',
                'popular_news' => 'Popular News',
                'search_placeholder' => 'Search verified news...',
                'search_btn' => 'Search',
                'home' => 'Home',
                'welcome' => 'Welcome',
                'dashboard' => 'Dashboard',
                'logout' => 'Logout',
                'journalist_login' => 'Journalist Login',
                'apply_journalist' => 'Apply as Journalist',
                'read_more' => 'Read more',
                'read_story' => 'Read story →',
                'no_posts' => 'No posts found in this category.',
                'posts_by' => 'Posts by',
                'posts_related' => 'Posts related to',
                'footer_desc' => 'Publishing verified news to fight misinformation.',
                'all_rights' => 'All rights reserved.'
            ],
            'ar' => [
                'latest_news' => 'آخر الأخبار',
                'popular_news' => 'الأخبار الشائعة',
                'search_placeholder' => 'ابحث في الأخبار الموثوقة...',
                'search_btn' => 'بحث',
                'home' => 'الرئيسية',
                'welcome' => 'مرحباً',
                'dashboard' => 'لوحة التحكم',
                'logout' => 'تسجيل خروج',
                'journalist_login' => 'دخول الصحفيين',
                'apply_journalist' => 'انضم كصحفي',
                'read_more' => 'اقرأ المزيد',
                'read_story' => '← اقرأ القصة',
                'no_posts' => 'لا توجد منشورات في هذا القسم.',
                'posts_by' => 'المنشورات في قسم',
                'posts_related' => 'المنشورات المتعلقة بـ',
                'footer_desc' => 'نشر الأخبار الموثوقة لمحاربة التضليل.',
                'all_rights' => 'جميع الحقوق محفوظة.'
            ]
        ];
    }
    
    $lang = $_SESSION['lang'] ?? 'en';
    return $translations[$lang][$key] ?? $key;
}

// Dynamic API Translation for Database Content (Titles, Bodies)
function translate_api($text) {
    $lang = $_SESSION['lang'] ?? 'en';
    if ($lang === 'en' || empty(trim($text))) return $text;
    
    $cacheFile = __DIR__ . '/translation_cache.json';
    $cache = [];
    if (file_exists($cacheFile)) {
        $cache = json_decode(file_get_contents($cacheFile), true) ?: [];
    }
    
    $md5 = md5($text);
    if (isset($cache[$md5])) {
        return $cache[$md5];
    }
    
    // Call Google Translate API
    $url = "https://translate.googleapis.com/translate_a/single?client=gtx&sl=en&tl=ar&dt=t&q=" . urlencode($text);
    $options = ["http" => ["header" => "User-Agent: Mozilla/5.0\r\n"]];
    $context = stream_context_create($options);
    $response = @file_get_contents($url, false, $context);
    
    if ($response) {
        $result = json_decode($response, true);
        $translated = '';
        if (isset($result[0]) && is_array($result[0])) {
            foreach ($result[0] as $t) {
                $translated .= $t[0];
            }
        }
        if ($translated) {
            $cache[$md5] = $translated;
            file_put_contents($cacheFile, json_encode($cache, JSON_UNESCAPED_UNICODE));
            return $translated;
        }
    }
    
    return $text;
}
?>
