<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Artikel - BeritaCoding</title>
</head>
<body>
    <h1>Daftar Artikel</h1>
    
    <?php if (!empty($articles)): ?>
        <ul>
            <?php foreach ($articles as $article): ?>
                <li>
                    <h3><a href="/article/<?= $article['title'] ?>"><?= $article['title'] ?></a></h3>
                    <p><?= $article['content'] ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>Tidak ada artikel yang tersedia saat ini.</p>
    <?php endif; ?>
    
    <p><a href="/">Kembali ke Halaman Utama</a></p>
</body>
</html>