<?= $this->extend('_partials/layout') ?>

<?= $this->section('content') ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Edit Artikel</h1>
        <a href="/dashboard" class="btn btn-outline">
            <i class="icon-arrow-left"></i> Kembali ke Dashboard
        </a>
    </div>

    <!-- Flash Messages -->
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-error">
            <?= session()->getFlashdata('error') ?>
        </div>
    <?php endif; ?>

    <!-- Validation Errors -->
    <?php if (isset($validation)): ?>
        <div class="alert alert-error">
            <ul>
                <?php foreach ($validation->getErrors() as $error): ?>
                    <li><?= esc($error) ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php endif; ?>

    <div class="article-form-container">
        <form action="/dashboard/update/<?= $article['id'] ?>" method="POST" enctype="multipart/form-data" class="article-form">
            <?= csrf_field() ?>
            <input type="hidden" name="_method" value="PUT">
            
            <div class="form-grid">
                <!-- Main Content -->
                <div class="form-main">
                    <div class="form-group">
                        <label for="title">Judul Artikel *</label>
                        <input type="text" id="title" name="title" class="form-control" 
                               value="<?= old('title', $article['title']) ?>" required>
                        <small class="form-help">Judul yang menarik dan deskriptif</small>
                    </div>

                    <div class="form-group">
                        <label for="content">Konten Artikel *</label>
                        <textarea id="content" name="content" class="form-control content-editor" 
                                  rows="15" required><?= old('content', $article['content']) ?></textarea>
                        <small class="form-help">Konten lengkap artikel (minimal 50 karakter)</small>
                    </div>

                    <div class="form-group">
                        <label for="excerpt">Ringkasan</label>
                        <textarea id="excerpt" name="excerpt" class="form-control" 
                                  rows="3"><?= old('excerpt', $article['excerpt']) ?></textarea>
                        <small class="form-help">Ringkasan singkat artikel (opsional, maksimal 500 karakter)</small>
                    </div>

                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" id="tags" name="tags" class="form-control" 
                               value="<?= old('tags', $article['tags']) ?>" placeholder="php, codeigniter, tutorial">
                        <small class="form-help">Pisahkan dengan koma (contoh: php, tutorial, web)</small>
                    </div>
                </div>

                <!-- Sidebar -->
                <div class="form-sidebar">
                    <div class="sidebar-section">
                        <h3>Pengaturan Publikasi</h3>
                        
                        <div class="form-group">
                            <label for="status">Status *</label>
                            <select id="status" name="status" class="form-control" required>
                                <option value="draft" <?= old('status', $article['status']) === 'draft' ? 'selected' : '' ?>>Draft</option>
                                <option value="published" <?= old('status', $article['status']) === 'published' ? 'selected' : '' ?>>Dipublikasikan</option>
                                <option value="archived" <?= old('status', $article['status']) === 'archived' ? 'selected' : '' ?>>Diarsipkan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="author">Penulis *</label>
                            <input type="text" id="author" name="author" class="form-control" 
                                   value="<?= old('author', $article['author']) ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select id="category_id" name="category_id" class="form-control">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>" 
                                            <?= old('category_id', $article['category_id']) == $category['id'] ? 'selected' : '' ?>>
                                        <?= esc($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="sidebar-section">
                        <h3>Gambar Artikel</h3>
                        
                        <?php if ($article['image']): ?>
                            <div class="current-image">
                                <label>Gambar Saat Ini:</label>
                                <img src="/uploads/articles/<?= $article['image'] ?>" alt="Current Image" class="current-img">
                            </div>
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label for="image">Upload Gambar Baru</label>
                            <input type="file" id="image" name="image" class="form-control" 
                                   accept="image/*">
                            <small class="form-help">Format: JPG, PNG, GIF. Maksimal 2MB. Kosongkan jika tidak ingin mengubah.</small>
                        </div>

                        <div id="image-preview" class="image-preview" style="display: none;">
                            <img id="preview-img" src="" alt="Preview">
                            <button type="button" id="remove-image" class="btn btn-sm btn-danger">Hapus Preview</button>
                        </div>
                    </div>

                    <div class="sidebar-section">
                        <h3>Informasi Artikel</h3>
                        <div class="article-info">
                            <p><strong>Dibuat:</strong> <?= date('d/m/Y H:i', strtotime($article['created_at'])) ?></p>
                            <p><strong>Diperbarui:</strong> <?= date('d/m/Y H:i', strtotime($article['updated_at'])) ?></p>
                            <?php if ($article['published_at']): ?>
                                <p><strong>Dipublikasi:</strong> <?= date('d/m/Y H:i', strtotime($article['published_at'])) ?></p>
                            <?php endif; ?>
                            <p><strong>Slug:</strong> <code><?= esc($article['slug']) ?></code></p>
                            <?php if ($article['views']): ?>
                                <p><strong>Views:</strong> <?= number_format($article['views']) ?></p>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="sidebar-section">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-full">
                                <i class="icon-save"></i> Perbarui Artikel
                            </button>
                            
                            <?php if ($article['status'] === 'published'): ?>
                                <a href="/artikel/<?= $article['slug'] ?>" class="btn btn-secondary btn-full" target="_blank">
                                    <i class="icon-eye"></i> Lihat Artikel
                                </a>
                            <?php endif; ?>
                            
                            <a href="/dashboard" class="btn btn-outline btn-full">
                                <i class="icon-x"></i> Batal
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
// Image preview functionality
document.getElementById('image').addEventListener('change', function(e) {
    const file = e.target.files[0];
    const preview = document.getElementById('image-preview');
    const previewImg = document.getElementById('preview-img');
    
    if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
            previewImg.src = e.target.result;
            preview.style.display = 'block';
        };
        reader.readAsDataURL(file);
    } else {
        preview.style.display = 'none';
    }
});

// Remove image preview
document.getElementById('remove-image').addEventListener('click', function() {
    document.getElementById('image').value = '';
    document.getElementById('image-preview').style.display = 'none';
});
</script>
<?= $this->endSection() ?>