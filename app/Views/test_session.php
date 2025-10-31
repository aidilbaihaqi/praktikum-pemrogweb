<?= $this->include('_partials/head') ?>

<body>
    <?= $this->include('_partials/navbar') ?>

    <div class="container">
        <div class="main-content">
            <div class="card">
                <h2>Session Test Page</h2>
                
                <h3>Session Information:</h3>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 10px 0;">
                    <p><strong>User ID:</strong> <?= session()->get('user_id') ?? 'Not set' ?></p>
                    <p><strong>Username:</strong> <?= session()->get('username') ?? 'Not set' ?></p>
                    <p><strong>Email:</strong> <?= session()->get('email') ?? 'Not set' ?></p>
                    <p><strong>Full Name:</strong> <?= session()->get('full_name') ?? 'Not set' ?></p>
                    <p><strong>Role:</strong> <?= session()->get('role') ?? 'Not set' ?></p>
                    <p><strong>Is Active:</strong> <?= session()->get('is_active') ? 'Yes' : 'No' ?></p>
                    <p><strong>Avatar:</strong> <?= session()->get('avatar') ?? 'Not set' ?></p>
                </div>

                <h3>Authentication Status:</h3>
                <div style="background: #f8f9fa; padding: 15px; border-radius: 5px; margin: 10px 0;">
                    <?php if (session()->get('user_id')): ?>
                        <p style="color: green;"><strong>✓ User is logged in</strong></p>
                        <p>Welcome back, <?= session()->get('full_name') ?>!</p>
                        <a href="<?= site_url('/profile') ?>" class="btn btn-primary">Go to Profile</a>
                        <a href="<?= site_url('/logout') ?>" class="btn btn-secondary">Logout</a>
                    <?php else: ?>
                        <p style="color: red;"><strong>✗ User is not logged in</strong></p>
                        <p>Please login to access protected features.</p>
                        <a href="<?= site_url('/login') ?>" class="btn btn-primary">Login</a>
                        <a href="<?= site_url('/register') ?>" class="btn btn-secondary">Register</a>
                    <?php endif; ?>
                </div>

                <h3>Test Links:</h3>
                <div style="margin: 20px 0;">
                    <a href="<?= site_url('/') ?>" class="btn btn-outline">Home</a>
                    <a href="<?= site_url('/login') ?>" class="btn btn-outline">Login Page</a>
                    <a href="<?= site_url('/register') ?>" class="btn btn-outline">Register Page</a>
                    <a href="<?= site_url('/profile') ?>" class="btn btn-outline">Profile Page (Protected)</a>
                </div>

                <h3>Instructions:</h3>
                <div style="background: #e3f2fd; padding: 15px; border-radius: 5px; margin: 10px 0;">
                    <p><strong>Test Credentials:</strong></p>
                    <ul>
                        <li>Admin: admin@beritacoding.com / admin123</li>
                        <li>User: user1@example.com / user123</li>
                        <li>Editor: editor@beritacoding.com / editor123</li>
                    </ul>
                    
                    <p><strong>Test Scenarios:</strong></p>
                    <ol>
                        <li>Try accessing /profile without login (should redirect to login)</li>
                        <li>Login with valid credentials</li>
                        <li>Try accessing /login after login (should redirect to home)</li>
                        <li>Access /profile after login (should work)</li>
                        <li>Logout and verify session is cleared</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('_partials/footer') ?>
</body>
</html>