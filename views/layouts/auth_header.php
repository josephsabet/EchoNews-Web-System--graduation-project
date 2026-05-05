<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EchoNews</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Merriweather:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/news/css/global.css?v=<?php echo time(); ?>">
    <style>
        /* Auth page: full-screen centered layout, no navbar */
        body {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0F172A 0%, #1E293B 50%, #0F172A 100%);
        }

        /* Branding above the card */
        .auth-brand {
            text-align: center;
            margin-bottom: 30px;
        }

        .auth-brand-logo {
            font-family: 'Merriweather', serif;
            font-size: 38px;
            color: #FFFFFF;
            text-decoration: none;
            letter-spacing: -1px;
        }

        .auth-brand-logo span {
            color: var(--primary-blue, #4F46E5);
        }

        .auth-brand-tagline {
            color: #94A3B8;
            font-size: 13px;
            margin-top: 6px;
        }

        /* Override auth-section so it's not double-centering */
        .auth-section {
            display: block;
            padding: 0;
            animation: none;
            width: 100%;
            max-width: 480px;
            padding: 0 20px 40px;
        }

        /* Enhance card for full-page feel */
        .auth-card {
            box-shadow: 0 25px 60px -15px rgba(0,0,0,0.5);
        }
    </style>
</head>
<body>
    <div class="auth-brand">
        <a href="/news/pages/index.php" class="auth-brand-logo">Echo<span>News</span></a>
        <p class="auth-brand-tagline">The Editorial Platform</p>
    </div>
