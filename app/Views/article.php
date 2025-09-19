<?= $this->include('_partials/head') ?>

<body>
    <?= $this->include('_partials/navbar') ?>
    
    <main class="main-content">
        <div class="container">
            <div class="page-header">
                <h1>Daftar Artikel</h1>
                <p>Kumpulan artikel terbaru seputar programming dan teknologi</p>
            </div>
            
            <div class="articles-section">
                <?php if (!empty($articles)): ?>
                    <div class="articles-grid">
                        <?php foreach ($articles as $article): ?>
                            <article class="article-card">
                                <div class="article-header">
                                    <h3 class="article-title">
                                        <a href="/article/<?= esc($article['slug'] ?? $article['title']) ?>"><?= esc($article['title']) ?></a>
                                    </h3>
                                    <div class="article-meta">
                                        <span class="article-date"><?= date('d M Y', strtotime($article['created_at'] ?? 'now')) ?></span>
                                        <span class="article-author">By <?= esc($article['author'] ?? 'Admin') ?></span>
                                    </div>
                                </div>
                                <div class="article-content">
                                    <p><?= esc(substr($article['content'], 0, 150)) ?>...</p>
                                </div>
                                <div class="article-footer">
                                    <a href="/article/<?= esc($article['slug'] ?? $article['title']) ?>" class="btn btn-primary">Baca Selengkapnya</a>
                                    <div class="article-tags">
                                        <?php if (!empty($article['tags'])): ?>
                                            <?php foreach (explode(',', $article['tags']) as $tag): ?>
                                                <span class="tag"><?= esc(trim($tag)) ?></span>
                                            <?php endforeach; ?>
                                        <?php else: ?>
                                            <span class="tag">Programming</span>
                                        <?php endif; ?>
                                    </div>
                                </div>
                            </article>
                        <?php endforeach; ?>
                    </div>
                <?php else: ?>
                    <div class="empty-state">
                        <div class="empty-icon">📝</div>
                        <h3>Belum Ada Artikel</h3>
                        <p>Tidak ada artikel yang tersedia saat ini. Silakan kembali lagi nanti!</p>
                        <a href="<?= site_url('/') ?>" class="btn btn-primary">Kembali ke Beranda</a>
                    </div>
                <?php endif; ?>
            </div>
            
            <!-- Pagination (jika diperlukan) -->
            <div class="pagination-wrapper">
                <!-- Pagination akan ditambahkan di sini jika diperlukan -->
            </div>
        </div>
    </main>
    
    <?= $this->include('_partials/footer') ?>
</body>
</html>