<?= $this->include('_partials/head') ?>

<body>
    <?= $this->include('_partials/navbar') ?>

    <div class="profile-container">
        <div class="profile-wrapper">
            <div class="profile-card">
                <!-- Header -->
                <div class="profile-header">
                    <h1>Pengaturan Profil</h1>
                    <p>Kelola informasi profil dan pengaturan akun Anda</p>
                </div>

                <!-- Flash Messages -->
                <div class="profile-content">
                    <?php if (session()->getFlashdata('error')): ?>
                        <div class="alert alert-error">
                            <?= session()->getFlashdata('error') ?>
                        </div>
                    <?php endif; ?>

                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <div class="profile-grid">
                        <!-- Profile Information -->
                        <div class="profile-main">
                            <h2 class="profile-section-title">Informasi Profil</h2>
                                
                            <form action="/profile" method="POST" enctype="multipart/form-data">
                                <?= csrf_field() ?>
                                
                                <!-- Avatar -->
                                <div class="form-row">
                                    <label class="form-group label">Avatar</label>
                                    <div class="avatar-container">
                                        <?php if ($user['avatar']): ?>
                                            <img id="avatar-preview" class="avatar-preview" 
                                                 src="/uploads/avatars/<?= $user['avatar'] ?>" 
                                                 alt="Avatar">
                                        <?php else: ?>
                                            <div id="avatar-preview" class="avatar-placeholder">
                                                <svg fill="currentColor" viewBox="0 0 20 20">
                                                    <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z" clip-rule="evenodd"></path>
                                                </svg>
                                            </div>
                                        <?php endif; ?>
                                        <div class="avatar-upload">
                                            <input type="file" id="avatar" name="avatar" accept="image/*" class="file-input">
                                            <p class="file-help">JPG, JPEG, PNG. Maksimal 2MB.</p>
                                            <?php if (isset($validation) && $validation->hasError('avatar')): ?>
                                                <p class="error-message"><?= $validation->getError('avatar') ?></p>
                                            <?php endif; ?>
                                        </div>
                                        <?php if ($user['avatar']): ?>
                                            <button type="button" id="delete-avatar" class="delete-avatar-btn">
                                                Hapus
                                            </button>
                                        <?php endif; ?>
                                    </div>
                                </div>

                                <!-- Username -->
                                <div class="form-row">
                                    <label for="username" class="form-group label">Username</label>
                                    <input type="text" id="username" name="username" required
                                           class="form-control <?= isset($validation) && $validation->hasError('username') ? 'error' : '' ?>"
                                           value="<?= old('username', $user['username']) ?>">
                                    <?php if (isset($validation) && $validation->hasError('username')): ?>
                                        <p class="error-message"><?= $validation->getError('username') ?></p>
                                    <?php endif; ?>
                                </div>

                                <!-- Email -->
                                <div class="form-row">
                                    <label for="email" class="form-group label">Email</label>
                                    <input type="email" id="email" name="email" required
                                           class="form-control <?= isset($validation) && $validation->hasError('email') ? 'error' : '' ?>"
                                           value="<?= old('email', $user['email']) ?>">
                                    <?php if (isset($validation) && $validation->hasError('email')): ?>
                                        <p class="error-message"><?= $validation->getError('email') ?></p>
                                    <?php endif; ?>
                                </div>

                                <!-- Full Name -->
                                <div class="form-row">
                                    <label for="full_name" class="form-group label">Nama Lengkap</label>
                                    <input type="text" id="full_name" name="full_name" required
                                           class="form-control <?= isset($validation) && $validation->hasError('full_name') ? 'error' : '' ?>"
                                           value="<?= old('full_name', $user['full_name']) ?>">
                                    <?php if (isset($validation) && $validation->hasError('full_name')): ?>
                                        <p class="error-message"><?= $validation->getError('full_name') ?></p>
                                    <?php endif; ?>
                                </div>

                                <!-- Bio -->
                                <div class="form-row">
                                    <label for="bio" class="form-group label">Bio</label>
                                    <textarea id="bio" name="bio" rows="4"
                                              class="form-textarea <?= isset($validation) && $validation->hasError('bio') ? 'error' : '' ?>"
                                              placeholder="Ceritakan sedikit tentang diri Anda"><?= old('bio', $user['bio']) ?></textarea>
                                    <?php if (isset($validation) && $validation->hasError('bio')): ?>
                                        <p class="error-message"><?= $validation->getError('bio') ?></p>
                                    <?php endif; ?>
                                    <p class="file-help">Maksimal 1000 karakter</p>
                                </div>

                                <div class="form-row">
                                    <button type="submit" class="btn btn-primary btn-full">
                                        Simpan Perubahan
                                    </button>
                                </div>
                            </form>
                        </div>

                        <!-- Sidebar -->
                        <div class="profile-sidebar">
                            <!-- Account Info -->
                            <div class="sidebar-card">
                                <h3>Informasi Akun</h3>
                                <div class="info-list">
                                    <div class="info-item">
                                        <div>
                                            <div class="info-label">Status</div>
                                            <div class="info-value">
                                                <span class="status-badge <?= $user['is_active'] ? 'status-active' : 'status-inactive' ?>">
                                                    <?= $user['is_active'] ? 'Aktif' : 'Tidak Aktif' ?>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Role</div>
                                        <div class="info-value" style="text-transform: capitalize;"><?= $user['role'] ?></div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Bergabung</div>
                                        <div class="info-value"><?= date('d M Y', strtotime($user['created_at'])) ?></div>
                                    </div>
                                    <div class="info-item">
                                        <div class="info-label">Login Terakhir</div>
                                        <div class="info-value">
                                            <?= $user['last_login'] ? date('d M Y H:i', strtotime($user['last_login'])) : 'Belum pernah' ?>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Change Password -->
                            <div class="sidebar-card">
                                <h3>Ubah Password</h3>
                                
                                <form action="/profile/change-password" method="POST">
                                    <?= csrf_field() ?>
                                    
                                    <div class="form-row">
                                        <label for="current_password" class="form-group label">Password Saat Ini</label>
                                        <input type="password" id="current_password" name="current_password" required
                                               class="form-control">
                                        <?php if (isset($validation) && $validation->hasError('current_password')): ?>
                                            <p class="error-message"><?= $validation->getError('current_password') ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-row">
                                        <label for="new_password" class="form-group label">Password Baru</label>
                                        <input type="password" id="new_password" name="new_password" required
                                               class="form-control">
                                        <?php if (isset($validation) && $validation->hasError('new_password')): ?>
                                            <p class="error-message"><?= $validation->getError('new_password') ?></p>
                                        <?php endif; ?>
                                        <p class="file-help">Minimal 6 karakter</p>
                                    </div>

                                    <div class="form-row">
                                        <label for="confirm_password" class="form-group label">Konfirmasi Password Baru</label>
                                        <input type="password" id="confirm_password" name="confirm_password" required
                                               class="form-control">
                                        <?php if (isset($validation) && $validation->hasError('confirm_password')): ?>
                                            <p class="error-message"><?= $validation->getError('confirm_password') ?></p>
                                        <?php endif; ?>
                                    </div>

                                    <div class="form-row">
                                        <button type="submit" class="btn btn-danger btn-full">
                                            Ubah Password
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('_partials/footer') ?>

    <script>
        // Avatar preview
        document.getElementById('avatar').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const preview = document.getElementById('avatar-preview');
                    preview.innerHTML = `<img class="h-16 w-16 rounded-full object-cover" src="${e.target.result}" alt="Avatar">`;
                };
                reader.readAsDataURL(file);
            }
        });

        // Delete avatar
        const deleteAvatarBtn = document.getElementById('delete-avatar');
        if (deleteAvatarBtn) {
            deleteAvatarBtn.addEventListener('click', function() {
                if (confirm('Apakah Anda yakin ingin menghapus avatar?')) {
                    fetch('/profile/avatar', {
                        method: 'DELETE',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'X-CSRF-TOKEN': document.querySelector('input[name="csrf_token"]').value
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            location.reload();
                        } else {
                            alert('Gagal menghapus avatar: ' + data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        alert('Terjadi kesalahan saat menghapus avatar');
                    });
                }
            });
        }
    </script>
</body>
</html>