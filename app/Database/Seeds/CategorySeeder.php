<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Web Development',
                'slug' => 'web-development',
                'description' => 'Tutorial dan artikel tentang pengembangan web menggunakan berbagai teknologi seperti HTML, CSS, JavaScript, PHP, dan framework modern.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Mobile Development',
                'slug' => 'mobile-development',
                'description' => 'Panduan lengkap pengembangan aplikasi mobile untuk Android dan iOS menggunakan berbagai platform dan framework.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Database',
                'slug' => 'database',
                'description' => 'Tutorial database mulai dari konsep dasar hingga optimasi query untuk MySQL, PostgreSQL, MongoDB, dan database lainnya.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Programming Languages',
                'slug' => 'programming-languages',
                'description' => 'Pelajari berbagai bahasa pemrograman seperti PHP, Python, JavaScript, Java, C++, dan bahasa pemrograman populer lainnya.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'description' => 'Tutorial tentang DevOps, CI/CD, containerization dengan Docker, deployment, monitoring, dan automation tools.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
            [
                'name' => 'Data Science',
                'slug' => 'data-science',
                'description' => 'Artikel dan tutorial tentang data science, machine learning, artificial intelligence, dan analisis data.',
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s'),
            ],
        ];

        // Insert data
        $this->db->table('categories')->insertBatch($data);
    }
}
