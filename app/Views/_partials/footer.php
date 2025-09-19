<footer class="footer">
        <div class="footer-container">
            <div class="footer-content">
                <div class="footer-section">
                    <h3>BeritaCoding</h3>
                    <p>Website berita dan tutorial coding terbaru untuk developer Indonesia.</p>
                </div>
                <div class="footer-section">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a href="<?= site_url('/') ?>">Home</a></li>
                        <li><a href="<?= site_url('/about') ?>">About</a></li>
                        <li><a href="<?= site_url('/article') ?>">Articles</a></li>
                        <li><a href="<?= site_url('/contact') ?>">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-section">
                    <h4>Contact Info</h4>
                    <p>Email: info@beritacoding.com</p>
                    <p>Phone: +62 123 456 789</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; <?= date('Y') ?> BeritaCoding. Aidil Baihaqi All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const navToggle = document.querySelector('.nav-toggle');
        const navMenu = document.querySelector('.nav-menu');

        navToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
        });
    </script>
</body>
</html>