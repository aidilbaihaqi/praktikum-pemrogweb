<?= $this->include('_partials/head') ?>
<body>
    <?= $this->include('_partials/navbar') ?>
    
    <div class="main-content">
        <div class="page-header">
            <div class="container">
                <h1>Hubungi Kami</h1>
                <p>Kami siap membantu Anda. Kirimkan pesan melalui form di bawah ini</p>
            </div>
        </div>
        
        <div class="container">
            <div class="form-container">
                <div class="card">
                    <h2>Kirim Pesan</h2>
                    
                    <?php if (session()->getFlashdata('success')): ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php endif; ?>

                    <form action="<?= site_url('/contact') ?>" method="post">
                        <?= csrf_field() ?>
                        
                        <div class="form-group">
                            <label for="name">Nama Lengkap</label>
                            <input type="text" name="name" id="name" class="form-control" 
                                   placeholder="Masukkan nama lengkap Anda" 
                                   value="<?= isset($input['name']) ? esc($input['name']) : '' ?>" required/>
                            <?php if (isset($validation) && $validation->hasError('name')): ?>
                                <div class="error-message"><?= $validation->getError('name') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="email">Alamat Email</label>
                            <input type="email" name="email" id="email" class="form-control" 
                                   placeholder="Masukkan alamat email Anda" 
                                   value="<?= isset($input['email']) ? esc($input['email']) : '' ?>" required/>
                            <?php if (isset($validation) && $validation->hasError('email')): ?>
                                <div class="error-message"><?= $validation->getError('email') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <label for="message">Pesan</label>
                            <textarea name="message" id="message" class="form-control" rows="6" 
                                      placeholder="Tulis pesan Anda di sini..." required><?= isset($input['message']) ? esc($input['message']) : '' ?></textarea>
                            <?php if (isset($validation) && $validation->hasError('message')): ?>
                                <div class="error-message"><?= $validation->getError('message') ?></div>
                            <?php endif; ?>
                        </div>

                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Kirim Pesan</button>
                            <button type="reset" class="btn btn-secondary">Reset Form</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <?= $this->include('_partials/footer') ?>
</body>
</html>