<?= $this->extend('_partials/layout') ?>

<?= $this->section('content') ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Dashboard - Kelola Artikel</h1>
        <a href="/dashboard/create" class="btn btn-primary">
            <i class="icon-plus"></i> Tambah Artikel Baru
        </a>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success">
            <?= session()->getFlashdata('success') ?>
        </div>
    <?php endif; ?>

    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon stat-total">
                <i class="icon-file"></i>
            </div>
            <div class="stat-content">
                <h3><?= $stats['total'] ?></h3>
                <p>Total Artikel</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon stat-published">
                <i class="icon-check"></i>
            </div>
            <div class="stat-content">
                <h3><?= $stats['published'] ?></h3>
                <p>Dipublikasikan</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon stat-draft">
                <i class="icon-edit"></i>
            </div>
            <div class="stat-content">
                <h3><?= $stats['draft'] ?></h3>
                <p>Draft</p>
            </div>
        </div>
        
        <div class="stat-card">
            <div class="stat-icon stat-archived">
                <i class="icon-archive"></i>
            </div>
            <div class="stat-content">
                <h3><?= $stats['archived'] ?></h3>
                <p>Diarsipkan</p>
            </div>
        </div>
    </div>

    <!-- Filters -->
    <div class="dashboard-filters">
        <form method="GET" action="/dashboard" class="filter-form">
            <div class="filter-group">
                <input type="text" name="search" placeholder="Cari artikel..." 
                       value="<?= esc($filters['search']) ?>" class="form-control">
            </div>
            
            <div class="filter-group">
                <select name="status" class="form-control">
                    <option value="all" <?= $filters['status'] === 'all' ? 'selected' : '' ?>>Semua Status</option>
                    <option value="published" <?= $filters['status'] === 'published' ? 'selected' : '' ?>>Dipublikasikan</option>
                    <option value="draft" <?= $filters['status'] === 'draft' ? 'selected' : '' ?>>Draft</option>
                    <option value="archived" <?= $filters['status'] === 'archived' ? 'selected' : '' ?>>Diarsipkan</option>
                </select>
            </div>
            
            <div class="filter-group">
                <select name="category" class="form-control">
                    <option value="all" <?= $filters['category'] === 'all' ? 'selected' : '' ?>>Semua Kategori</option>
                    <?php foreach ($categories as $category): ?>
                        <option value="<?= $category['id'] ?>" 
                                <?= $filters['category'] == $category['id'] ? 'selected' : '' ?>>
                            <?= esc($category['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>
            
            <div class="filter-group">
                <button type="submit" class="btn btn-secondary">Filter</button>
                <a href="/dashboard" class="btn btn-outline">Reset</a>
            </div>
        </form>
    </div>

    <!-- Articles Table -->
    <div class="dashboard-table">
        <?php if (empty($articles)): ?>
            <div class="empty-state">
                <i class="icon-file"></i>
                <h3>Belum ada artikel</h3>
                <p>Mulai dengan menambahkan artikel pertama Anda.</p>
                <a href="/dashboard/create" class="btn btn-primary">Tambah Artikel</a>
            </div>
        <?php else: ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Judul</th>
                        <th>Kategori</th>
                        <th>Penulis</th>
                        <th>Status</th>
                        <th>Tanggal</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($articles as $article): ?>
                        <tr>
                            <td>
                                <div class="article-title">
                                    <h4><?= esc($article['title']) ?></h4>
                                    <?php if ($article['excerpt']): ?>
                                        <p class="article-excerpt"><?= esc(character_limiter($article['excerpt'], 80)) ?></p>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <?php if ($article['category_name']): ?>
                                    <span class="category-badge"><?= esc($article['category_name']) ?></span>
                                <?php else: ?>
                                    <span class="category-badge category-none">Tanpa Kategori</span>
                                <?php endif; ?>
                            </td>
                            <td><?= esc($article['author']) ?></td>
                            <td>
                                <span class="status-badge status-<?= $article['status'] ?>">
                                    <?php
                                    $statusLabels = [
                                        'published' => 'Dipublikasikan',
                                        'draft' => 'Draft',
                                        'archived' => 'Diarsipkan'
                                    ];
                                    echo $statusLabels[$article['status']] ?? $article['status'];
                                    ?>
                                </span>
                            </td>
                            <td>
                                <div class="article-date">
                                    <small>Dibuat: <?= date('d/m/Y', strtotime($article['created_at'])) ?></small>
                                    <?php if ($article['published_at']): ?>
                                        <small>Dipublikasi: <?= date('d/m/Y', strtotime($article['published_at'])) ?></small>
                                    <?php endif; ?>
                                </div>
                            </td>
                            <td>
                                <div class="action-buttons">
                                    <?php if ($article['status'] === 'published'): ?>
                                        <a href="/artikel/<?= $article['slug'] ?>" class="btn btn-sm btn-outline" target="_blank" title="Lihat">
                                            <i class="icon-eye"></i>
                                        </a>
                                    <?php endif; ?>
                                    
                                    <a href="/dashboard/edit/<?= $article['id'] ?>" class="btn btn-sm btn-secondary" title="Edit">
                                        <i class="icon-edit"></i>
                                    </a>
                                    
                                    <form method="POST" action="/dashboard/toggle-status/<?= $article['id'] ?>" style="display: inline;">
                                        <?= csrf_field() ?>
                                        <button type="submit" class="btn btn-sm <?= $article['status'] === 'published' ? 'btn-warning' : 'btn-success' ?>" 
                                                title="<?= $article['status'] === 'published' ? 'Jadikan Draft' : 'Publikasikan' ?>">
                                            <i class="icon-<?= $article['status'] === 'published' ? 'pause' : 'play' ?>"></i>
                                        </button>
                                    </form>
                                    
                                    <form method="POST" action="/dashboard/delete/<?= $article['id'] ?>" style="display: inline;" 
                                          onsubmit="return confirm('Apakah Anda yakin ingin menghapus artikel ini?')">
                                        <?= csrf_field() ?>
                                        <input type="hidden" name="_method" value="DELETE">
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="icon-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Pagination -->
            <?php if ($pagination['total_pages'] > 1): ?>
                <div class="pagination-wrapper">
                    <div class="pagination-info">
                        Menampilkan <?= ($pagination['current_page'] - 1) * $pagination['per_page'] + 1 ?> - 
                        <?= min($pagination['current_page'] * $pagination['per_page'], $pagination['total_items']) ?> 
                        dari <?= $pagination['total_items'] ?> artikel
                    </div>
                    
                    <div class="pagination">
                        <?php if ($pagination['current_page'] > 1): ?>
                            <a href="?page=<?= $pagination['current_page'] - 1 ?><?= $filters['search'] ? '&search=' . urlencode($filters['search']) : '' ?><?= $filters['status'] && $filters['status'] !== 'all' ? '&status=' . $filters['status'] : '' ?><?= $filters['category'] && $filters['category'] !== 'all' ? '&category=' . $filters['category'] : '' ?>" 
                               class="pagination-btn">« Sebelumnya</a>
                        <?php endif; ?>
                        
                        <?php for ($i = max(1, $pagination['current_page'] - 2); $i <= min($pagination['total_pages'], $pagination['current_page'] + 2); $i++): ?>
                            <a href="?page=<?= $i ?><?= $filters['search'] ? '&search=' . urlencode($filters['search']) : '' ?><?= $filters['status'] && $filters['status'] !== 'all' ? '&status=' . $filters['status'] : '' ?><?= $filters['category'] && $filters['category'] !== 'all' ? '&category=' . $filters['category'] : '' ?>" 
                               class="pagination-btn <?= $i === $pagination['current_page'] ? 'active' : '' ?>"><?= $i ?></a>
                        <?php endfor; ?>
                        
                        <?php if ($pagination['current_page'] < $pagination['total_pages']): ?>
                            <a href="?page=<?= $pagination['current_page'] + 1 ?><?= $filters['search'] ? '&search=' . urlencode($filters['search']) : '' ?><?= $filters['status'] && $filters['status'] !== 'all' ? '&status=' . $filters['status'] : '' ?><?= $filters['category'] && $filters['category'] !== 'all' ? '&category=' . $filters['category'] : '' ?>" 
                               class="pagination-btn">Selanjutnya »</a>
                        <?php endif; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
</div>
<?= $this->endSection() ?>