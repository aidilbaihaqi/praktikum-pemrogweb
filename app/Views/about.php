<?= $this->include('_partials/head') ?>
<body>
    <?= $this->include('_partials/navbar') ?>
    
    <div class="main-content">
        <div class="page-header">
            <div class="container">
                <h1>Tentang BeritaCoding</h1>
                <p>Mengenal lebih dekat dengan platform pembelajaran coding terdepan di Indonesia</p>
            </div>
        </div>
        
        <div class="container">
            <div class="card">
                <h2>Visi Kami</h2>
                <p>Menjadi platform pembelajaran coding terdepan di Indonesia yang membantu developer dari berbagai tingkat keahlian untuk terus berkembang dan mengikuti perkembangan teknologi terkini.</p>
            </div>
            
            <div class="card">
                <h2>Misi Kami</h2>
                <ul>
                    <li>Menyediakan konten berkualitas tinggi tentang programming dan teknologi</li>
                    <li>Membangun komunitas developer yang saling mendukung dan berbagi pengetahuan</li>
                    <li>Memberikan tutorial praktis yang dapat langsung diterapkan dalam proyek nyata</li>
                    <li>Menghadirkan berita terkini seputar dunia teknologi dan programming</li>
                </ul>
            </div>
            
            <div class="card">
                <h2>Tim Kami</h2>
                <p>BeritaCoding didukung oleh tim yang berpengalaman di bidang teknologi dan pendidikan. Kami terdiri dari:</p>
                <ul>
                    <li><strong>Developer Berpengalaman</strong> - Dengan pengalaman lebih dari 5 tahun di industri teknologi</li>
                    <li><strong>Content Creator</strong> - Ahli dalam membuat konten edukatif yang mudah dipahami</li>
                    <li><strong>Community Manager</strong> - Membantu membangun dan memelihara komunitas yang aktif</li>
                </ul>
            </div>
            
            <div class="card">
                <h2>Mengapa Memilih BeritaCoding?</h2>
                <div class="articles-grid">
                    <div class="article-card">
                        <div class="article-content">
                            <h3>Konten Berkualitas</h3>
                            <p>Setiap artikel dan tutorial telah melalui proses review yang ketat untuk memastikan kualitas dan akurasi informasi.</p>
                        </div>
                    </div>
                    
                    <div class="article-card">
                        <div class="article-content">
                            <h3>Update Terkini</h3>
                            <p>Kami selalu mengikuti perkembangan teknologi terbaru dan menyajikan informasi yang up-to-date.</p>
                        </div>
                    </div>
                    
                    <div class="article-card">
                        <div class="article-content">
                            <h3>Komunitas Aktif</h3>
                            <p>Bergabung dengan ribuan developer lainnya untuk saling berbagi pengalaman dan pengetahuan.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card text-center">
                <h2>Bergabung Dengan Kami</h2>
                <p>Siap untuk memulai perjalanan coding Anda? Jelajahi artikel-artikel kami dan bergabung dengan komunitas developer Indonesia!</p>
                <a href="<?= site_url('/') ?>" class="btn btn-primary">Mulai Belajar</a>
                <a href="<?= site_url('/contact') ?>" class="btn btn-secondary">Hubungi Kami</a>
            </div>
        </div>
    </div>

    <?= $this->include('_partials/footer') ?>
</body>
</html>