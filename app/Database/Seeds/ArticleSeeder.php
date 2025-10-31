<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class ArticleSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'title' => 'Memulai Belajar HTML dan CSS untuk Pemula',
                'slug' => 'memulai-belajar-html-css-pemula',
                'content' => '<h2>Pengenalan HTML dan CSS</h2><p>HTML (HyperText Markup Language) adalah bahasa markup yang digunakan untuk membuat struktur halaman web. CSS (Cascading Style Sheets) adalah bahasa yang digunakan untuk mengatur tampilan dan layout halaman web.</p><h3>Struktur Dasar HTML</h3><p>Setiap dokumen HTML memiliki struktur dasar yang terdiri dari elemen-elemen penting seperti DOCTYPE, html, head, dan body. Dalam tutorial ini, kita akan mempelajari cara membuat halaman web sederhana menggunakan HTML dan CSS.</p><p>Mari kita mulai dengan membuat file HTML pertama Anda dan mempelajari tag-tag dasar yang sering digunakan dalam pengembangan web.</p>',
                'excerpt' => 'Pelajari dasar-dasar HTML dan CSS untuk memulai perjalanan Anda dalam pengembangan web. Tutorial lengkap untuk pemula.',
                'image' => 'https://via.placeholder.com/800x400/4f46e5/ffffff?text=HTML+CSS+Tutorial',
                'category_id' => 1, // Web Development
                'author' => 'Admin BeritaCoding',
                'tags' => 'HTML, CSS, Web Development, Tutorial, Pemula',
                'status' => 'published',
                'views' => 150,
                'published_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-7 days')),
            ],
            [
                'title' => 'Panduan Lengkap JavaScript ES6+ untuk Developer Modern',
                'slug' => 'panduan-javascript-es6-developer-modern',
                'content' => '<h2>Fitur-Fitur Baru JavaScript ES6+</h2><p>JavaScript ES6 (ECMAScript 2015) membawa banyak fitur baru yang membuat coding menjadi lebih efisien dan mudah dibaca. Dalam artikel ini, kita akan membahas fitur-fitur penting seperti arrow functions, destructuring, template literals, dan masih banyak lagi.</p><h3>Arrow Functions</h3><p>Arrow functions adalah cara baru untuk menulis function dalam JavaScript yang lebih singkat dan memiliki behavior yang berbeda untuk this binding.</p><h3>Destructuring Assignment</h3><p>Destructuring memungkinkan kita untuk mengekstrak nilai dari array atau object dengan syntax yang lebih clean dan readable.</p>',
                'excerpt' => 'Eksplorasi fitur-fitur modern JavaScript ES6+ yang akan meningkatkan produktivitas coding Anda sebagai developer.',
                'image' => 'https://via.placeholder.com/800x400/f59e0b/ffffff?text=JavaScript+ES6',
                'category_id' => 1, // Web Development
                'author' => 'John Doe',
                'tags' => 'JavaScript, ES6, Programming, Modern JavaScript, Arrow Functions',
                'status' => 'published',
                'views' => 230,
                'published_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-5 days')),
            ],
            [
                'title' => 'Membuat Aplikasi Android dengan Kotlin: Tutorial Step by Step',
                'slug' => 'membuat-aplikasi-android-kotlin-tutorial',
                'content' => '<h2>Mengapa Memilih Kotlin untuk Android Development?</h2><p>Kotlin telah menjadi bahasa pemrograman resmi untuk pengembangan Android sejak Google mengumumkannya di Google I/O 2017. Kotlin menawarkan syntax yang lebih concise, null safety, dan interoperability yang sempurna dengan Java.</p><h3>Setup Development Environment</h3><p>Sebelum memulai, pastikan Anda telah menginstall Android Studio dan SDK yang diperlukan. Kita akan membuat project baru dan mengkonfigurasi Kotlin sebagai bahasa utama.</p><h3>Membuat UI dengan XML dan Kotlin</h3><p>Dalam tutorial ini, kita akan belajar cara membuat interface yang menarik dan menghubungkannya dengan logic menggunakan Kotlin.</p>',
                'excerpt' => 'Tutorial komprehensif untuk membuat aplikasi Android menggunakan Kotlin dari nol hingga publish ke Play Store.',
                'image' => 'https://via.placeholder.com/800x400/10b981/ffffff?text=Android+Kotlin',
                'category_id' => 2, // Mobile Development
                'author' => 'Jane Smith',
                'tags' => 'Android, Kotlin, Mobile Development, Tutorial, App Development',
                'status' => 'published',
                'views' => 180,
                'published_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-3 days')),
            ],
            [
                'title' => 'Optimasi Query MySQL: Tips dan Trik untuk Performance Terbaik',
                'slug' => 'optimasi-query-mysql-tips-performance',
                'content' => '<h2>Pentingnya Optimasi Database</h2><p>Optimasi query MySQL adalah kunci untuk mendapatkan performance aplikasi yang optimal. Database yang lambat dapat menjadi bottleneck utama dalam aplikasi web modern.</p><h3>Indexing Strategy</h3><p>Index adalah salah satu tools paling powerful untuk mempercepat query. Namun, penggunaan index yang salah justru bisa memperlambat performance, terutama untuk operasi INSERT, UPDATE, dan DELETE.</p><h3>Query Optimization Techniques</h3><p>Pelajari berbagai teknik optimasi seperti penggunaan EXPLAIN, menghindari SELECT *, menggunakan LIMIT dengan bijak, dan masih banyak lagi.</p>',
                'excerpt' => 'Pelajari teknik-teknik advanced untuk mengoptimasi query MySQL dan meningkatkan performance database aplikasi Anda.',
                'image' => 'https://via.placeholder.com/800x400/ef4444/ffffff?text=MySQL+Optimization',
                'category_id' => 3, // Database
                'author' => 'Database Expert',
                'tags' => 'MySQL, Database, Optimization, Performance, SQL, Indexing',
                'status' => 'published',
                'views' => 95,
                'published_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-2 days')),
            ],
            [
                'title' => 'Python untuk Data Science: Pandas dan NumPy Essentials',
                'slug' => 'python-data-science-pandas-numpy-essentials',
                'content' => '<h2>Mengapa Python untuk Data Science?</h2><p>Python telah menjadi bahasa pemrograman pilihan utama untuk data science karena ecosystem library yang kaya dan syntax yang mudah dipahami. Pandas dan NumPy adalah dua library fundamental yang harus dikuasai.</p><h3>NumPy: Foundation of Data Science</h3><p>NumPy menyediakan struktur data array yang efisien dan operasi matematika yang cepat. Library ini menjadi foundation untuk hampir semua library data science Python lainnya.</p><h3>Pandas: Data Manipulation Made Easy</h3><p>Pandas menyediakan struktur data DataFrame yang powerful untuk manipulasi dan analisis data. Dengan Pandas, Anda bisa melakukan cleaning, transformation, dan analysis data dengan mudah.</p>',
                'excerpt' => 'Kuasai fundamental Python untuk data science dengan mempelajari Pandas dan NumPy dari dasar hingga advanced.',
                'image' => 'https://via.placeholder.com/800x400/8b5cf6/ffffff?text=Python+Data+Science',
                'category_id' => 6, // Data Science
                'author' => 'Data Scientist',
                'tags' => 'Python, Data Science, Pandas, NumPy, Machine Learning, Analytics',
                'status' => 'published',
                'views' => 210,
                'published_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'created_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
                'updated_at' => date('Y-m-d H:i:s', strtotime('-1 day')),
            ],
            [
                'title' => 'Docker dan Kubernetes: Containerization untuk Production',
                'slug' => 'docker-kubernetes-containerization-production',
                'content' => '<h2>Era Containerization</h2><p>Containerization telah mengubah cara kita deploy dan manage aplikasi. Docker dan Kubernetes adalah tools yang essential untuk modern DevOps practices.</p><h3>Docker Fundamentals</h3><p>Docker memungkinkan kita untuk package aplikasi beserta dependencies-nya dalam container yang portable dan consistent across different environments.</p><h3>Kubernetes Orchestration</h3><p>Kubernetes adalah platform orchestration yang powerful untuk managing containerized applications di scale. Pelajari concepts seperti Pods, Services, Deployments, dan ConfigMaps.</p><h3>Production Best Practices</h3><p>Implementasi security, monitoring, logging, dan scaling strategies untuk production-ready containerized applications.</p>',
                'excerpt' => 'Pelajari Docker dan Kubernetes untuk containerization aplikasi modern dengan best practices untuk production environment.',
                'image' => 'https://via.placeholder.com/800x400/06b6d4/ffffff?text=Docker+Kubernetes',
                'category_id' => 5, // DevOps
                'author' => 'DevOps Engineer',
                'tags' => 'Docker, Kubernetes, DevOps, Containerization, Production, Deployment',
                'status' => 'published',
                'views' => 165,
                'published_at' => date('Y-m-d H:i:s'),
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        $this->db->table('articles')->insertBatch($data);
    }
}
