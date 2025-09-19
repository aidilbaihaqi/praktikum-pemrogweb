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
                <a href="<?= site_url('/article') ?>" class="nav-link <?= uri_string() == 'article' ? 'active' : '' ?>">Articles</a>
            </li>
            <li class="nav-item">
                <a href="<?= site_url('/contact') ?>" class="nav-link <?= uri_string() == 'contact' ? 'active' : '' ?>">Contact</a>
            </li>
        </ul>
        <div class="nav-toggle">
            <span class="bar"></span>
            <span class="bar"></span>
            <span class="bar"></span>
        </div>
    </div>
</nav>