<?= $this->include('_partials/head') ?>

<body>
    <?= $this->include('_partials/navbar') ?>
    
    <main class="main-content">
    <div class="container">
        <!-- Article Detail -->
        <article class="article-detail">
            <!-- Article Header -->
            <header class="article-detail-header">
                <div class="article-breadcrumb">
                    <a href="<?= base_url() ?>">Home</a>
                    <span>/</span>
                    <a href="<?= base_url('article') ?>">Artikel</a>
                    <span>/</span>
                    <span><?= esc($article['title']) ?></span>
                </div>
                
                <h1 class="article-detail-title"><?= esc($article['title']) ?></h1>
                
                <div class="article-detail-meta">
                    <div class="article-meta-item">
                        <i class="fas fa-user"></i>
                        <span><?= esc($article['author']) ?></span>
                    </div>
                    <div class="article-meta-item">
                        <i class="fas fa-calendar"></i>
                        <span><?= date('d M Y', strtotime($article['created_at'])) ?></span>
                    </div>
                    <div class="article-meta-item">
                        <i class="fas fa-clock"></i>
                        <span><?= esc($article['reading_time']) ?></span>
                    </div>
                </div>
                
                <div class="article-tags">
                    <?php 
                    $tags = explode(', ', $article['tags']);
                    foreach ($tags as $tag): 
                    ?>
                        <span class="tag"><?= esc(trim($tag)) ?></span>
                    <?php endforeach; ?>
                </div>
            </header>

            <!-- Article Image -->
            <?php if (!empty($article['image'])): ?>
            <div class="article-detail-image">
                <img src="<?= base_url($article['image']) ?>" alt="<?= esc($article['title']) ?>" onerror="this.src='<?= base_url('images/placeholder.png') ?>'">
            </div>
            <?php endif; ?>

            <!-- Article Content -->
            <div class="article-detail-content">
                <?= nl2br(esc($article['content'])) ?>
            </div>

            <!-- Article Footer -->
            <footer class="article-detail-footer">
                <div class="article-share">
                    <h4>Bagikan Artikel:</h4>
                    <div class="share-buttons">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(current_url()) ?>" target="_blank" class="share-btn facebook">
                            <i class="fab fa-facebook-f"></i>
                            Facebook
                        </a>
                        <a href="https://twitter.com/intent/tweet?url=<?= urlencode(current_url()) ?>&text=<?= urlencode($article['title']) ?>" target="_blank" class="share-btn twitter">
                            <i class="fab fa-twitter"></i>
                            Twitter
                        </a>
                        <a href="https://www.linkedin.com/sharing/share-offsite/?url=<?= urlencode(current_url()) ?>" target="_blank" class="share-btn linkedin">
                            <i class="fab fa-linkedin-in"></i>
                            LinkedIn
                        </a>
                        <a href="https://wa.me/?text=<?= urlencode($article['title'] . ' - ' . current_url()) ?>" target="_blank" class="share-btn whatsapp">
                            <i class="fab fa-whatsapp"></i>
                            WhatsApp
                        </a>
                    </div>
                </div>
            </footer>
        </article>

        <!-- Related Articles -->
        <?php if (!empty($related_articles)): ?>
        <section class="related-articles">
            <h2>Artikel Terkait</h2>
            <div class="related-articles-grid">
                <?php foreach ($related_articles as $related): ?>
                <div class="related-article-card">
                    <div class="related-article-image">
                        <img src="<?= base_url($related['image']) ?>" alt="<?= esc($related['title']) ?>" onerror="this.src='<?= base_url('images/placeholder.png') ?>'">
                    </div>
                    <div class="related-article-content">
                        <h3 class="related-article-title">
                            <a href="<?= base_url('article/' . $related['slug']) ?>"><?= esc($related['title']) ?></a>
                        </h3>
                        <div class="related-article-meta">
                            <span class="related-article-date"><?= date('d M Y', strtotime($related['created_at'])) ?></span>
                            <span class="related-article-reading-time"><?= esc($related['reading_time']) ?></span>
                        </div>
                        <p class="related-article-excerpt">
                            <?= esc(substr(strip_tags($related['content']), 0, 120)) ?>...
                        </p>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </section>
        <?php endif; ?>

        <!-- Navigation -->
        <div class="article-navigation">
            <a href="<?= base_url('article') ?>" class="btn btn-outline">
                <i class="fas fa-arrow-left"></i>
                Kembali ke Artikel
            </a>
        </div>
    </div>
</main>

<?= $this->include('_partials/footer') ?>
</body>
</html>