<?php include __DIR__ . '/../layouts/auth_header.php'; ?>
        <section class="auth-section">
            <div class="auth-card">
                <h2 class="auth-title">Welcome Back</h2>
                <p class="auth-subtitle">Login to the EchoNews editorial system.</p>
                <?php if (isset($error)): ?>
                    <div class="auth-error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <form id="login-form" method="post" class="auth-form">
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="journalist@echonews.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>
                    <button type="submit" class="auth-submit-btn">Secure Login</button>
                    <p class="auth-link-text">Don't have an account? <a href="signup.php">Apply as Journalist</a></p>
                </form>
            </div>
        </section>
<?php include __DIR__ . '/../layouts/auth_footer.php'; ?>
