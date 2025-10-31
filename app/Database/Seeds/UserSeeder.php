<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Data dummy untuk testing
        $data = [
            [
                'username' => 'admin',
                'email' => 'admin@beritacoding.com',
                'password' => password_hash('admin123', PASSWORD_DEFAULT),
                'full_name' => 'Administrator',
                'bio' => 'Administrator BeritaCoding',
                'role' => 'admin',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'user1',
                'email' => 'user1@example.com',
                'password' => password_hash('user123', PASSWORD_DEFAULT),
                'full_name' => 'User Satu',
                'bio' => 'Pengguna biasa BeritaCoding',
                'role' => 'user',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ],
            [
                'username' => 'editor',
                'email' => 'editor@beritacoding.com',
                'password' => password_hash('editor123', PASSWORD_DEFAULT),
                'full_name' => 'Editor BeritaCoding',
                'bio' => 'Editor konten BeritaCoding',
                'role' => 'editor',
                'is_active' => 1,
                'created_at' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            ]
        ];

        // Insert data ke database
        $this->db->table('users')->insertBatch($data);
        
        echo "User seeder berhasil dijalankan!\n";
        echo "Data user yang ditambahkan:\n";
        echo "- admin@beritacoding.com (password: admin123)\n";
        echo "- user1@example.com (password: user123)\n";
        echo "- editor@beritacoding.com (password: editor123)\n";
    }
}
