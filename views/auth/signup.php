<?php include __DIR__ . '/../layouts/auth_header.php'; ?>
        <section class="auth-section">
            <div class="auth-card">
                <h2 class="auth-title">Create an Account</h2>
                <p class="auth-subtitle">Apply as a Journalist for EchoNews.</p>
                <?php if (isset($error)): ?>
                    <div class="auth-error"><?php echo htmlspecialchars($error); ?></div>
                <?php endif; ?>
                <form id="register-form" method="POST" action="" class="auth-form">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" placeholder="johndoe" required>
                    </div>
                    <div class="form-group">
                        <label for="email">Email Address</label>
                        <input type="email" id="email" name="email" placeholder="john@example.com" required>
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" placeholder="••••••••" required>
                    </div>
                    <div class="form-group">
                        <label for="confirm-password">Confirm Password</label>
                        <input type="password" id="confirm-password" name="confirm_password" placeholder="••••••••" required>
                    </div>
                    <div class="form-group">
                        <label for="phone">Phone Number</label>
                        <input type="tel" id="phone" name="phone" placeholder="+1 234 567 890" required>
                    </div>
                    <button type="submit" name="submit" class="auth-submit-btn">Submit Application</button>
                    <p class="auth-link-text">Already have an account? <a href="login.php">Login here</a></p>
                </form>
            </div>
        </section>
<?php include __DIR__ . '/../layouts/auth_footer.php'; ?>
