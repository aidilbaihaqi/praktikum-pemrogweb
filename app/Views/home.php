<?= $this->include('_partials/head') ?>
<body>
    <?= $this->include('_partials/navbar') ?>
    
    <div class="main-content">
        <div class="page-header">
            <div class="container">
                <h1>Selamat Datang di BeritaCoding</h1>
                <p>Portal berita dan tutorial coding terbaru untuk developer Indonesia</p>
            </div>
        </div>
        
        <div class="container">
            <div class="articles-grid">
                <div class="article-card">
                    <div class="article-content">
                        <a href="#" class="article-title">Tutorial PHP untuk Pemula</a>
                        <p>Pelajari dasar-dasar PHP dari nol hingga mahir. Tutorial lengkap dengan contoh kode dan praktik terbaik.</p>
                        <small class="text-muted">Dipublikasikan 2 hari yang lalu</small>
                    </div>
                </div>
                
                <div class="article-card">
                    <div class="article-content">
                        <a href="#" class="article-title">CodeIgniter 4 Best Practices</a>
                        <p>Tips dan trik menggunakan CodeIgniter 4 untuk membangun aplikasi web yang scalable dan maintainable.</p>
                        <small class="text-muted">Dipublikasikan 5 hari yang lalu</small>
                    </div>
                </div>
                
                <div class="article-card">
                    <div class="article-content">
                        <a href="#" class="article-title">JavaScript ES6+ Features</a>
                        <p>Eksplorasi fitur-fitur terbaru JavaScript ES6+ yang akan meningkatkan produktivitas coding Anda.</p>
                        <small class="text-muted">Dipublikasikan 1 minggu yang lalu</small>
                    </div>
                </div>
                
                <div class="article-card">
                    <div class="article-content">
                        <a href="#" class="article-title">Database Design Fundamentals</a>
                        <p>Panduan lengkap merancang database yang efisien dan normalized untuk aplikasi modern.</p>
                        <small class="text-muted">Dipublikasikan 2 minggu yang lalu</small>
                    </div>
                </div>
                
                <div class="article-card">
                    <div class="article-content">
                        <a href="#" class="article-title">RESTful API Development</a>
                        <p>Belajar membangun RESTful API yang robust menggunakan PHP dan framework modern.</p>
                        <small class="text-muted">Dipublikasikan 3 minggu yang lalu</small>
                    </div>
                </div>
                
                <div class="article-card">
                    <div class="article-content">
                        <a href="#" class="article-title">Git Version Control</a>
                        <p>Menguasai Git untuk version control yang efektif dalam tim development.</p>
                        <small class="text-muted">Dipublikasikan 1 bulan yang lalu</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('_partials/footer') ?>
</body>
</html>
