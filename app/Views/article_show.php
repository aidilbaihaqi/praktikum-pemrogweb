<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $article['title'] ?> - BeritaCoding</title>
</head>
<body>
    <h1><?= $article['title'] ?></h1>
    
    <div class="article-meta">
        <p><strong>Artikel:</strong> <?= $article['title'] ?></p>
    </div>
    
    <div class="article-content">
        <?= $article['content'] ?>
    </div>
    
    <div class="navigation">
        <p><a href="/article">Kembali ke Daftar Artikel</a></p>
        <p><a href="/">Kembali ke Halaman Utama</a></p>
    </div>
</body>
</html>