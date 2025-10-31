<?= $this->include('_partials/head') ?>

<body>
    <?= $this->include('_partials/navbar') ?>

    <main class="main-content">
        <div class="container">
            <div class="form-container" style="margin-top: 50px;">
                <div class="text-center" style="margin-bottom: 40px;">
                    <div style="width: 80px; height: 80px; margin: 0 auto 20px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                        <svg style="width: 40px; height: 40px; color: white;" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                        </svg>
                    </div>
                    <h1 style="font-size: 2.5rem; margin-bottom: 10px; color: #333;">Masuk ke Akun Anda</h1>
                    <p style="color: #666; font-size: 1.1rem;">Silakan masuk untuk mengakses dashboard Anda</p>
                </div>

                <!-- Flash Messages -->
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

                <form action="/login" method="POST">
                    <?= csrf_field() ?>
                    
                    <div class="form-group">
                        <label for="login">Email atau Username</label>
                        <input id="login" name="login" type="text" required 
                               class="form-control <?= isset($validation) && $validation->hasError('login') ? 'error' : '' ?>" 
                               placeholder="Masukkan email atau username Anda"
                               value="<?= old('login') ?>">
                        <?php if (isset($validation) && $validation->hasError('login')): ?>
                            <p style="color: #dc3545; font-size: 14px; margin-top: 5px;"><?= $validation->getError('login') ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group">
                        <label for="password">Password</label>
                        <input id="password" name="password" type="password" required 
                               class="form-control <?= isset($validation) && $validation->hasError('password') ? 'error' : '' ?>" 
                               placeholder="Masukkan password Anda">
                        <?php if (isset($validation) && $validation->hasError('password')): ?>
                            <p style="color: #dc3545; font-size: 14px; margin-top: 5px;"><?= $validation->getError('password') ?></p>
                        <?php endif; ?>
                    </div>

                    <div class="form-group" style="display: flex; align-items: center; justify-content: space-between;">
                        <label style="display: flex; align-items: center; margin-bottom: 0;">
                            <input id="remember_me" name="remember_me" type="checkbox" style="margin-right: 8px;">
                            Ingat saya
                        </label>
                        <a href="#" style="color: #667eea; text-decoration: none; font-size: 14px;">Lupa password?</a>
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" style="width: 100%; font-size: 18px;">
                            Masuk
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>

    <?= $this->include('_partials/footer') ?>
</body>
</html>