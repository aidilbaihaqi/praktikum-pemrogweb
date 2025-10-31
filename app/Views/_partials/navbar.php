<nav class="navbar">
    <div class="nav-container">
        <div class="nav-brand">
            <a href="<?= site_url('/') ?>">BeritaCoding</a>
        </div>
        <ul class="nav-menu">
            <li class="nav-item">
                <a href="<?= site_url('/') ?>" class="nav-link <?= uri_string() == '' ? 'active' : '' ?>">Home</a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('/about') ?>" class="nav-link <?= uri_string() == 'about' ? 'active' : '' ?>">About</a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('/artikel') ?>" class="nav-link <?= strpos(uri_string(), 'artikel') === 0 ? 'active' : '' ?>">Articles</a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('/contact') ?>" class="nav-link <?= uri_string() == 'contact' ? 'active' : '' ?>">Contact</a>
            </li>
            
            <?php if (session()->get('user_id')): ?>
                <!-- User is logged in -->
                <li class="nav-item dropdown">
                    <a href="#" class="nav-link dropdown-toggle" id="userDropdown">
                        <?php if (session()->get('avatar')): ?>
                            <img src="/uploads/avatars/<?= session()->get('avatar') ?>" alt="Avatar" class="w-6 h-6 rounded-full inline-block mr-1">
                        <?php endif; ?>
                        <?= session()->get('username') ?>
                    </a>
                    <ul class="dropdown-menu">
                        <li><a href="<?= site_url('/profile') ?>" class="dropdown-link">Profil</a></li>
                        <li><a href="<?= site_url('/dashboard') ?>" class="dropdown-link">Dashboard</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a href="<?= site_url('/logout') ?>" class="dropdown-link">Logout</a></li>
                    </ul>
                </li>
            <?php else: ?>
                <!-- User is not logged in -->
                <li class="nav-item">
                    <a href="<?= site_url('/login') ?>" class="nav-link <?= uri_string() == 'login' ? 'active' : '' ?>">Login</a>
                </li>
            <?php endif; ?>
        </ul>
        <div class="nav-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </div>
</nav>