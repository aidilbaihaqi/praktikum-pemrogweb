<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        $data = [
            'meta' => [
                'title' => 'Beranda - BeritaCoding',
                'description' => 'Portal berita dan tutorial coding terbaru untuk developer Indonesia'
            ]
        ];
        return view('home', $data);
    }
    
    public function about(): string
    {
        $data = [
            'meta' => [
                'title' => 'Tentang Kami - BeritaCoding',
                'description' => 'Pelajari lebih lanjut tentang BeritaCoding dan misi kami dalam dunia programming'
            ]
        ];
        return view('about', $data);
    }
    
    public function contact(): string
    {
        $data = [
            'meta' => [
                'title' => 'Kontak - BeritaCoding',
                'description' => 'Hubungi tim BeritaCoding untuk pertanyaan, saran, atau kerjasama'
            ]
        ];
        return view('contact', $data);
    }

    public function submitContact()
    {
        // Validasi input
        $validation = \Config\Services::validation();
        
        $validation->setRules([
            'name' => [
                'label' => 'Name',
                'rules' => 'required|min_length[2]|max_length[100]',
                'errors' => [
                    'required' => 'Nama harus diisi',
                    'min_length' => 'Nama minimal 2 karakter',
                    'max_length' => 'Nama maksimal 100 karakter'
                ]
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[255]',
                'errors' => [
                    'required' => 'Email harus diisi',
                    'valid_email' => 'Format email tidak valid',
                    'max_length' => 'Email maksimal 255 karakter'
                ]
            ],
            'message' => [
                'label' => 'Message',
                'rules' => 'required|min_length[10]|max_length[1000]',
                'errors' => [
                    'required' => 'Pesan harus diisi',
                    'min_length' => 'Pesan minimal 10 karakter',
                    'max_length' => 'Pesan maksimal 1000 karakter'
                ]
            ]
        ]);

        if (!$validation->withRequest($this->request)->run()) {
            // Jika validasi gagal, kembali ke form dengan error
            $data = [
                'meta' => [
                    'title' => 'Kontak - BeritaCoding',
                    'description' => 'Hubungi tim BeritaCoding untuk pertanyaan, saran, atau kerjasama'
                ],
                'validation' => $validation,
                'input' => $this->request->getPost()
            ];
            return view('contact', $data);
        }

        // Jika validasi berhasil, ambil data
        $name = $this->request->getPost('name');
        $email = $this->request->getPost('email');
        $message = $this->request->getPost('message');

        // Di sini Anda bisa menyimpan ke database atau mengirim email
        // Untuk sekarang, kita akan menampilkan pesan sukses
        
        // Set flash message untuk sukses
        session()->setFlashdata('success', 'Terima kasih! Pesan Anda telah berhasil dikirim.');
        
        // Redirect kembali ke halaman contact
        return redirect()->to('/contact');
    }

    public function article()
    {
        $data = [
            'meta' => [
                'title' => 'Daftar Artikel - BeritaCoding',
                'description' => 'Kumpulan artikel terbaru seputar programming, web development, dan teknologi terkini'
            ],
            'articles' => [
                [
                    'title' => 'Mengenal CodeIgniter 4: Framework PHP Modern',
                    'slug' => 'mengenal-codeigniter-4-framework-php-modern',
                    'content' => 'CodeIgniter 4 adalah framework PHP yang powerful dan mudah dipelajari. Dengan arsitektur yang lebih modern dan fitur-fitur terbaru, CodeIgniter 4 menjadi pilihan yang tepat untuk pengembangan aplikasi web.',
                    'author' => 'Admin BeritaCoding',
                    'created_at' => '2024-01-15',
                    'tags' => 'PHP, CodeIgniter, Framework'
                ],
                [
                    'title' => 'Tutorial JavaScript ES6: Arrow Functions dan Destructuring',
                    'slug' => 'tutorial-javascript-es6-arrow-functions-destructuring',
                    'content' => 'JavaScript ES6 membawa banyak fitur baru yang memudahkan developer dalam menulis kode. Dalam artikel ini, kita akan membahas arrow functions dan destructuring yang sangat berguna dalam pengembangan modern.',
                    'author' => 'Tim BeritaCoding',
                    'created_at' => '2024-01-12',
                    'tags' => 'JavaScript, ES6, Programming'
                ],
                [
                    'title' => 'Membangun API RESTful dengan PHP dan MySQL',
                    'slug' => 'membangun-api-restful-php-mysql',
                    'content' => 'API RESTful adalah standar dalam pengembangan web modern. Pelajari cara membangun API yang scalable dan secure menggunakan PHP dan MySQL dengan best practices yang tepat.',
                    'author' => 'Developer BeritaCoding',
                    'created_at' => '2024-01-10',
                    'tags' => 'PHP, MySQL, API, REST'
                ],
                [
                    'title' => 'CSS Grid vs Flexbox: Kapan Menggunakan Yang Mana?',
                    'slug' => 'css-grid-vs-flexbox-kapan-menggunakan',
                    'content' => 'CSS Grid dan Flexbox adalah dua teknologi layout yang powerful di CSS. Artikel ini akan membahas perbedaan keduanya dan kapan sebaiknya menggunakan masing-masing teknologi.',
                    'author' => 'UI/UX BeritaCoding',
                    'created_at' => '2024-01-08',
                    'tags' => 'CSS, Grid, Flexbox, Layout'
                ],
                [
                    'title' => 'Optimasi Database MySQL untuk Performa Maksimal',
                    'slug' => 'optimasi-database-mysql-performa-maksimal',
                    'content' => 'Performa database adalah kunci sukses aplikasi web. Pelajari teknik-teknik optimasi MySQL mulai dari indexing, query optimization, hingga konfigurasi server untuk performa terbaik.',
                    'author' => 'Database Expert',
                    'created_at' => '2024-01-05',
                    'tags' => 'MySQL, Database, Optimization, Performance'
                ],
                [
                    'title' => 'Keamanan Web: Mencegah SQL Injection dan XSS',
                    'slug' => 'keamanan-web-mencegah-sql-injection-xss',
                    'content' => 'Keamanan web adalah prioritas utama dalam pengembangan aplikasi. Artikel ini membahas cara mencegah serangan SQL Injection dan Cross-Site Scripting (XSS) dengan teknik yang proven.',
                    'author' => 'Security Expert',
                    'created_at' => '2024-01-03',
                    'tags' => 'Security, SQL Injection, XSS, Web Security'
                ]
            ]
        ];

        return view('article', $data);
    }

    public function articleDetail($slug)
    {
        // Data artikel dummy yang sama seperti di method article()
        $articles = [
            [
                'title' => 'Mengenal CodeIgniter 4: Framework PHP Modern',
                'slug' => 'mengenal-codeigniter-4-framework-php-modern',
                'content' => 'CodeIgniter 4 adalah framework PHP yang powerful dan mudah dipelajari. Dengan arsitektur yang lebih modern dan fitur-fitur terbaru, CodeIgniter 4 menjadi pilihan yang tepat untuk pengembangan aplikasi web.

CodeIgniter 4 hadir dengan banyak perbaikan dan fitur baru dibandingkan versi sebelumnya. Framework ini menggunakan namespace, autoloading yang lebih baik, dan mendukung PHP 7.4+.

Beberapa fitur unggulan CodeIgniter 4:
- Namespace dan autoloading yang modern
- RESTful routing yang fleksibel
- Database migration dan seeding
- Built-in development server
- Improved security features
- Better error handling dan debugging

Dengan dokumentasi yang lengkap dan komunitas yang aktif, CodeIgniter 4 sangat cocok untuk developer yang ingin membangun aplikasi web dengan cepat dan efisien.',
                'author' => 'Admin BeritaCoding',
                'created_at' => '2024-01-15',
                'tags' => 'PHP, CodeIgniter, Framework',
                'image' => '/images/placeholder.png',
                'reading_time' => '5 menit'
            ],
            [
                'title' => 'Tutorial JavaScript ES6: Arrow Functions dan Destructuring',
                'slug' => 'tutorial-javascript-es6-arrow-functions-destructuring',
                'content' => 'JavaScript ES6 membawa banyak fitur baru yang memudahkan developer dalam menulis kode. Dalam artikel ini, kita akan membahas arrow functions dan destructuring yang sangat berguna dalam pengembangan modern.

Arrow Functions:
Arrow functions adalah cara baru untuk menulis function di JavaScript dengan sintaks yang lebih singkat dan behavior yang berbeda untuk "this" keyword.

Contoh arrow function:
```javascript
// Function biasa
function add(a, b) {
    return a + b;
}

// Arrow function
const add = (a, b) => a + b;
```

Destructuring:
Destructuring memungkinkan kita untuk mengekstrak nilai dari array atau object dengan sintaks yang lebih clean.

Contoh destructuring:
```javascript
// Array destructuring
const [first, second] = [1, 2, 3];

// Object destructuring
const {name, age} = {name: "John", age: 30};
```

Fitur-fitur ini membuat kode JavaScript lebih readable dan maintainable.',
                'author' => 'Tim BeritaCoding',
                'created_at' => '2024-01-12',
                'tags' => 'JavaScript, ES6, Programming',
                'image' => '/images/placeholder.png',
                'reading_time' => '7 menit'
            ],
            [
                'title' => 'Membangun API RESTful dengan PHP dan MySQL',
                'slug' => 'membangun-api-restful-php-mysql',
                'content' => 'API RESTful adalah standar dalam pengembangan web modern. Pelajari cara membangun API yang scalable dan secure menggunakan PHP dan MySQL dengan best practices yang tepat.

Apa itu REST API?
REST (Representational State Transfer) adalah arsitektur untuk membangun web services yang menggunakan HTTP methods seperti GET, POST, PUT, DELETE.

Langkah-langkah membangun REST API:

1. Persiapan Database
Buat database dan tabel yang diperlukan dengan struktur yang normalized.

2. Routing
Definisikan endpoint API dengan HTTP methods yang sesuai:
- GET /api/users - Mengambil semua user
- GET /api/users/{id} - Mengambil user spesifik
- POST /api/users - Membuat user baru
- PUT /api/users/{id} - Update user
- DELETE /api/users/{id} - Hapus user

3. Authentication & Authorization
Implementasikan sistem autentikasi menggunakan JWT atau API key.

4. Validation & Error Handling
Validasi input dan berikan response error yang informatif.

5. Documentation
Dokumentasikan API menggunakan tools seperti Swagger atau Postman.',
                'author' => 'Developer BeritaCoding',
                'created_at' => '2024-01-10',
                'tags' => 'PHP, MySQL, API, REST',
                'image' => '/images/placeholder.png',
                'reading_time' => '10 menit'
            ],
            [
                'title' => 'CSS Grid vs Flexbox: Kapan Menggunakan Yang Mana?',
                'slug' => 'css-grid-vs-flexbox-kapan-menggunakan',
                'content' => 'CSS Grid dan Flexbox adalah dua teknologi layout yang powerful di CSS. Artikel ini akan membahas perbedaan keduanya dan kapan sebaiknya menggunakan masing-masing teknologi.

CSS Flexbox:
Flexbox dirancang untuk layout satu dimensi (baris atau kolom). Sangat cocok untuk:
- Navigation bars
- Card layouts
- Centering content
- Distribusi space antar elemen

Contoh Flexbox:
```css
.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
```

CSS Grid:
Grid dirancang untuk layout dua dimensi (baris dan kolom sekaligus). Ideal untuk:
- Page layouts
- Complex grid systems
- Overlapping elements
- Responsive design

Contoh Grid:
```css
.container {
    display: grid;
    grid-template-columns: 1fr 2fr 1fr;
    grid-gap: 20px;
}
```

Kapan menggunakan apa?
- Gunakan Flexbox untuk komponen UI dan layout sederhana
- Gunakan Grid untuk layout halaman dan struktur kompleks
- Keduanya bisa dikombinasikan dalam satu project',
                'author' => 'UI/UX BeritaCoding',
                'created_at' => '2024-01-08',
                'tags' => 'CSS, Grid, Flexbox, Layout',
                'image' => '/images/placeholder.png',
                'reading_time' => '6 menit'
            ],
            [
                'title' => 'Optimasi Database MySQL untuk Performa Maksimal',
                'slug' => 'optimasi-database-mysql-performa-maksimal',
                'content' => 'Performa database adalah kunci sukses aplikasi web. Pelajari teknik-teknik optimasi MySQL mulai dari indexing, query optimization, hingga konfigurasi server untuk performa terbaik.

1. Database Indexing
Index adalah kunci utama performa database. Buat index pada kolom yang sering digunakan dalam WHERE, JOIN, dan ORDER BY.

```sql
-- Membuat index
CREATE INDEX idx_user_email ON users(email);
CREATE INDEX idx_post_created ON posts(created_at);
```

2. Query Optimization
- Hindari SELECT *
- Gunakan LIMIT untuk membatasi hasil
- Optimasi JOIN queries
- Gunakan EXPLAIN untuk analisis query

3. Database Design
- Normalisasi yang tepat
- Pilih tipe data yang sesuai
- Partitioning untuk tabel besar

4. Server Configuration
- Optimasi my.cnf
- Memory allocation
- Connection pooling

5. Monitoring & Maintenance
- Regular ANALYZE TABLE
- Monitor slow query log
- Database backup strategy

Dengan menerapkan teknik-teknik ini, performa database MySQL bisa meningkat signifikan.',
                'author' => 'Database Expert',
                'created_at' => '2024-01-05',
                'tags' => 'MySQL, Database, Optimization, Performance',
                'image' => '/images/placeholder.png',
                'reading_time' => '12 menit'
            ],
            [
                'title' => 'Keamanan Web: Mencegah SQL Injection dan XSS',
                'slug' => 'keamanan-web-mencegah-sql-injection-xss',
                'content' => 'Keamanan web adalah prioritas utama dalam pengembangan aplikasi. Artikel ini membahas cara mencegah serangan SQL Injection dan Cross-Site Scripting (XSS) dengan teknik yang proven.

SQL Injection:
SQL Injection terjadi ketika attacker menyisipkan kode SQL berbahaya melalui input form.

Pencegahan SQL Injection:
1. Gunakan Prepared Statements
```php
$stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
$stmt->execute([$email]);
```

2. Input Validation
Validasi semua input dari user sebelum diproses.

3. Escape Special Characters
Gunakan fungsi escape yang disediakan database.

Cross-Site Scripting (XSS):
XSS memungkinkan attacker menyisipkan script berbahaya ke halaman web.

Pencegahan XSS:
1. Output Encoding
```php
echo htmlspecialchars($userInput, ENT_QUOTES, "UTF-8");
```

2. Content Security Policy (CSP)
Implementasikan CSP header untuk membatasi sumber script.

3. Input Sanitization
Bersihkan input dari tag HTML berbahaya.

4. HttpOnly Cookies
Set cookie dengan flag HttpOnly untuk mencegah akses via JavaScript.

Best Practices:
- Never trust user input
- Implement defense in depth
- Regular security audits
- Keep software updated',
                'author' => 'Security Expert',
                'created_at' => '2024-01-03',
                'tags' => 'Security, SQL Injection, XSS, Web Security',
                'image' => '/images/placeholder.png',
                'reading_time' => '8 menit'
            ]
        ];

        // Cari artikel berdasarkan slug
        $article = null;
        foreach ($articles as $item) {
            if ($item['slug'] === $slug) {
                $article = $item;
                break;
            }
        }

        // Jika artikel tidak ditemukan, redirect ke halaman artikel
        if (!$article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan');
        }

        $data = [
            'meta' => [
                'title' => $article['title'] . ' - BeritaCoding',
                'description' => substr(strip_tags($article['content']), 0, 160)
            ],
            'article' => $article,
            'related_articles' => array_slice(array_filter($articles, function($item) use ($slug) {
                return $item['slug'] !== $slug;
            }), 0, 3) // Ambil 3 artikel terkait
        ];

        return view('article_detail', $data);
    }
}
