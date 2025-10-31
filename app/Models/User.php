<?php

namespace App\Models;

use CodeIgniter\Model;

class User extends Model
{
    protected $table            = 'users';
    protected $primaryKey        = 'id';
    protected $useAutoIncrement  = true;
    protected $returnType        = 'array';
    protected $useSoftDeletes    = false;
    protected $protectFields     = true;
    protected $allowedFields     = [
        'username', 'email', 'password', 'full_name', 
        'avatar', 'bio', 'role', 'is_active', 'last_login'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';

    // Validation
    protected $validationRules = [
        'username' => [
            'label' => 'Username',
            'rules' => 'required|min_length[3]|max_length[50]|alpha_numeric_punct|is_unique[users.username,id,{id}]'
        ],
        'email' => [
            'label' => 'Email',
            'rules' => 'required|valid_email|max_length[100]|is_unique[users.email,id,{id}]'
        ],
        'password' => [
            'label' => 'Password',
            'rules' => 'required|min_length[6]|max_length[255]'
        ],
        'full_name' => [
            'label' => 'Nama Lengkap',
            'rules' => 'required|min_length[2]|max_length[100]'
        ],
        'avatar' => [
            'label' => 'Avatar',
            'rules' => 'permit_empty|max_length[255]'
        ],
        'bio' => [
            'label' => 'Bio',
            'rules' => 'permit_empty|max_length[1000]'
        ],
        'role' => [
            'label' => 'Role',
            'rules' => 'permit_empty|in_list[admin,editor,user]'
        ]
    ];

    protected $validationMessages = [
        'username' => [
            'required' => 'Username harus diisi',
            'min_length' => 'Username minimal 3 karakter',
            'max_length' => 'Username maksimal 50 karakter',
            'alpha_numeric_punct' => 'Username hanya boleh berisi huruf, angka, dan tanda baca',
            'is_unique' => 'Username sudah digunakan'
        ],
        'email' => [
            'required' => 'Email harus diisi',
            'valid_email' => 'Format email tidak valid',
            'max_length' => 'Email maksimal 100 karakter',
            'is_unique' => 'Email sudah terdaftar'
        ],
        'password' => [
            'required' => 'Password harus diisi',
            'min_length' => 'Password minimal 6 karakter',
            'max_length' => 'Password maksimal 255 karakter'
        ],
        'full_name' => [
            'required' => 'Nama lengkap harus diisi',
            'min_length' => 'Nama lengkap minimal 2 karakter',
            'max_length' => 'Nama lengkap maksimal 100 karakter'
        ]
    ];

    // Callbacks
    protected $beforeInsert = ['hashPassword'];
    protected $beforeUpdate = ['hashPassword'];

    protected function hashPassword(array $data)
    {
        if (isset($data['data']['password'])) {
            $data['data']['password'] = password_hash($data['data']['password'], PASSWORD_DEFAULT);
        }
        return $data;
    }

    // Authentication Methods
    public function authenticate($login, $password)
    {
        // Login bisa menggunakan username atau email
        $user = $this->where('username', $login)
                     ->orWhere('email', $login)
                     ->where('is_active', true)
                     ->first();

        if ($user && password_verify($password, $user['password'])) {
            // Update last login
            $this->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);
            
            // Remove password from return data
            unset($user['password']);
            return $user;
        }

        return false;
    }

    public function getUserById($id)
    {
        $user = $this->find($id);
        if ($user) {
            unset($user['password']);
        }
        return $user;
    }

    public function getUserByUsername($username)
    {
        $user = $this->where('username', $username)->first();
        if ($user) {
            unset($user['password']);
        }
        return $user;
    }

    public function getUserByEmail($email)
    {
        $user = $this->where('email', $email)->first();
        if ($user) {
            unset($user['password']);
        }
        return $user;
    }

    public function updateProfile($id, $data)
    {
        // Remove password from update if empty
        if (isset($data['password']) && empty($data['password'])) {
            unset($data['password']);
        }

        return $this->update($id, $data);
    }

    public function changePassword($id, $newPassword)
    {
        return $this->update($id, ['password' => $newPassword]);
    }

    public function isEmailExists($email, $excludeId = null)
    {
        $query = $this->where('email', $email);
        if ($excludeId) {
            $query->where('id !=', $excludeId);
        }
        return $query->countAllResults() > 0;
    }

    public function isUsernameExists($username, $excludeId = null)
    {
        $query = $this->where('username', $username);
        if ($excludeId) {
            $query->where('id !=', $excludeId);
        }
        return $query->countAllResults() > 0;
    }

    public function getActiveUsers()
    {
        return $this->where('is_active', true)
                    ->select('id, username, email, full_name, avatar, role, created_at, last_login')
                    ->findAll();
    }

    public function getUsersCount()
    {
        return $this->countAll();
    }

    public function getAdminUsers()
    {
        return $this->where('role', 'admin')
                    ->where('is_active', true)
                    ->select('id, username, email, full_name, avatar, created_at')
                    ->findAll();
    }
}