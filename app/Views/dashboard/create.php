<?= $this->extend('_partials/layout') ?>

<?= $this->section('content') ?>
<div class="dashboard-container">
    <div class="dashboard-header">
        <h1>Tambah Artikel Baru</h1>
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
        <form action="/dashboard/store" method="POST" enctype="multipart/form-data" class="article-form">
            <?= csrf_field() ?>
            
            <div class="form-grid">
                <!-- Main Content -->
                <div class="form-main">
                    <div class="form-group">
                        <label for="title">Judul Artikel *</label>
                        <input type="text" id="title" name="title" class="form-control" 
                               value="<?= old('title') ?>" required>
                        <small class="form-help">Judul yang menarik dan deskriptif</small>
                    </div>

                    <div class="form-group">
                        <label for="content">Konten Artikel *</label>
                        <textarea id="content" name="content" class="form-control content-editor" 
                                  rows="15" required><?= old('content') ?></textarea>
                        <small class="form-help">Konten lengkap artikel (minimal 50 karakter)</small>
                    </div>

                    <div class="form-group">
                        <label for="excerpt">Ringkasan</label>
                        <textarea id="excerpt" name="excerpt" class="form-control" 
                                  rows="3"><?= old('excerpt') ?></textarea>
                        <small class="form-help">Ringkasan singkat artikel (opsional, maksimal 500 karakter)</small>
                    </div>

                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <input type="text" id="tags" name="tags" class="form-control" 
                               value="<?= old('tags') ?>" placeholder="php, codeigniter, tutorial">
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
                                <option value="draft" <?= old('status') === 'draft' ? 'selected' : '' ?>>Draft</option>
                                <option value="published" <?= old('status') === 'published' ? 'selected' : '' ?>>Dipublikasikan</option>
                                <option value="archived" <?= old('status') === 'archived' ? 'selected' : '' ?>>Diarsipkan</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="author">Penulis *</label>
                            <input type="text" id="author" name="author" class="form-control" 
                                   value="<?= old('author') ?>" required>
                        </div>

                        <div class="form-group">
                            <label for="category_id">Kategori</label>
                            <select id="category_id" name="category_id" class="form-control">
                                <option value="">Pilih Kategori</option>
                                <?php foreach ($categories as $category): ?>
                                    <option value="<?= $category['id'] ?>" 
                                            <?= old('category_id') == $category['id'] ? 'selected' : '' ?>>
                                        <?= esc($category['name']) ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>

                    <div class="sidebar-section">
                        <h3>Gambar Artikel</h3>
                        
                        <div class="form-group">
                            <label for="image">Upload Gambar</label>
                            <input type="file" id="image" name="image" class="form-control" 
                                   accept="image/*">
                            <small class="form-help">Format: JPG, PNG, GIF. Maksimal 2MB</small>
                        </div>

                        <div id="image-preview" class="image-preview" style="display: none;">
                            <img id="preview-img" src="" alt="Preview">
                            <button type="button" id="remove-image" class="btn btn-sm btn-danger">Hapus</button>
                        </div>
                    </div>

                    <div class="sidebar-section">
                        <div class="form-actions">
                            <button type="submit" class="btn btn-primary btn-full">
                                <i class="icon-save"></i> Simpan Artikel
                            </button>
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

// Auto-generate slug from title (optional enhancement)
document.getElementById('title').addEventListener('input', function(e) {
    // This could be enhanced to show a slug preview
    console.log('Title changed:', e.target.value);
});
</script>
<?= $this->endSection() ?>