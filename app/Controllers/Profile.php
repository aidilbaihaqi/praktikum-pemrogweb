<?php

namespace App\Controllers;

use App\Models\User;

class Profile extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new User();
        $this->session = \Config\Services::session();
    }

    public function index()
    {
        // Check if user is logged in
        if (!$this->session->get('user_id')) {
            $this->session->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/login');
        }

        $userId = $this->session->get('user_id');
        $user = $this->userModel->getUserById($userId);

        if (!$user) {
            $this->session->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to('/');
        }

        $data = [
            'meta' => [
                'title' => 'Profil Saya - BeritaCoding',
                'description' => 'Kelola profil dan pengaturan akun Anda'
            ],
            'user' => $user,
            'validation' => \Config\Services::validation()
        ];

        return view('profile/index', $data);
    }

    public function update()
    {
        // Check if user is logged in
        if (!$this->session->get('user_id')) {
            $this->session->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/login');
        }

        $userId = $this->session->get('user_id');
        $currentUser = $this->userModel->getUserById($userId);

        if (!$currentUser) {
            $this->session->setFlashdata('error', 'User tidak ditemukan.');
            return redirect()->to('/');
        }

        $rules = [
            'username' => [
                'label' => 'Username',
                'rules' => 'required|min_length[3]|max_length[50]|alpha_numeric_punct|is_unique[users.username,id,' . $userId . ']'
            ],
            'email' => [
                'label' => 'Email',
                'rules' => 'required|valid_email|max_length[100]|is_unique[users.email,id,' . $userId . ']'
            ],
            'full_name' => [
                'label' => 'Nama Lengkap',
                'rules' => 'required|min_length[2]|max_length[100]'
            ],
            'bio' => [
                'label' => 'Bio',
                'rules' => 'permit_empty|max_length[1000]'
            ]
        ];

        $messages = [
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
            'full_name' => [
                'required' => 'Nama lengkap harus diisi',
                'min_length' => 'Nama lengkap minimal 2 karakter',
                'max_length' => 'Nama lengkap maksimal 100 karakter'
            ],
            'bio' => [
                'max_length' => 'Bio maksimal 1000 karakter'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $updateData = [
            'username' => $this->request->getPost('username'),
            'email' => $this->request->getPost('email'),
            'full_name' => $this->request->getPost('full_name'),
            'bio' => $this->request->getPost('bio')
        ];

        // Handle avatar upload
        $avatar = $this->request->getFile('avatar');
        if ($avatar && $avatar->isValid() && !$avatar->hasMoved()) {
            $validationRules = [
                'avatar' => [
                    'label' => 'Avatar',
                    'rules' => 'uploaded[avatar]|is_image[avatar]|mime_in[avatar,image/jpg,image/jpeg,image/png]|max_size[avatar,2048]'
                ]
            ];

            $validationMessages = [
                'avatar' => [
                    'uploaded' => 'Pilih file avatar',
                    'is_image' => 'File harus berupa gambar',
                    'mime_in' => 'Format gambar harus JPG, JPEG, atau PNG',
                    'max_size' => 'Ukuran file maksimal 2MB'
                ]
            ];

            if ($this->validate($validationRules, $validationMessages)) {
                // Create uploads directory if not exists
                $uploadPath = FCPATH . 'uploads/avatars/';
                if (!is_dir($uploadPath)) {
                    mkdir($uploadPath, 0755, true);
                }

                // Generate unique filename
                $newName = $avatar->getRandomName();
                
                if ($avatar->move($uploadPath, $newName)) {
                    // Delete old avatar if exists
                    if ($currentUser['avatar'] && file_exists(FCPATH . 'uploads/avatars/' . $currentUser['avatar'])) {
                        unlink(FCPATH . 'uploads/avatars/' . $currentUser['avatar']);
                    }
                    
                    $updateData['avatar'] = $newName;
                } else {
                    $this->session->setFlashdata('error', 'Gagal mengupload avatar.');
                    return redirect()->back()->withInput();
                }
            } else {
                return redirect()->back()->withInput()->with('validation', $this->validator);
            }
        }

        if ($this->userModel->updateProfile($userId, $updateData)) {
            // Update session data
            $this->session->set([
                'username' => $updateData['username'],
                'email' => $updateData['email'],
                'full_name' => $updateData['full_name'],
                'avatar' => $updateData['avatar'] ?? $currentUser['avatar']
            ]);

            $this->session->setFlashdata('success', 'Profil berhasil diperbarui.');
        } else {
            $this->session->setFlashdata('error', 'Gagal memperbarui profil.');
        }

        return redirect()->to('/profile');
    }

    public function changePassword()
    {
        // Check if user is logged in
        if (!$this->session->get('user_id')) {
            $this->session->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/login');
        }

        $userId = $this->session->get('user_id');

        $rules = [
            'current_password' => [
                'label' => 'Password Saat Ini',
                'rules' => 'required'
            ],
            'new_password' => [
                'label' => 'Password Baru',
                'rules' => 'required|min_length[6]|max_length[255]'
            ],
            'confirm_password' => [
                'label' => 'Konfirmasi Password Baru',
                'rules' => 'required|matches[new_password]'
            ]
        ];

        $messages = [
            'current_password' => [
                'required' => 'Password saat ini harus diisi'
            ],
            'new_password' => [
                'required' => 'Password baru harus diisi',
                'min_length' => 'Password baru minimal 6 karakter',
                'max_length' => 'Password baru maksimal 255 karakter'
            ],
            'confirm_password' => [
                'required' => 'Konfirmasi password harus diisi',
                'matches' => 'Konfirmasi password tidak cocok'
            ]
        ];

        if (!$this->validate($rules, $messages)) {
            return redirect()->back()->with('validation', $this->validator);
        }

        // Verify current password
        $currentPassword = $this->request->getPost('current_password');
        $user = $this->userModel->find($userId);
        
        if (!password_verify($currentPassword, $user['password'])) {
            $this->session->setFlashdata('error', 'Password saat ini salah.');
            return redirect()->back();
        }

        $newPassword = $this->request->getPost('new_password');
        
        if ($this->userModel->changePassword($userId, $newPassword)) {
            $this->session->setFlashdata('success', 'Password berhasil diubah.');
        } else {
            $this->session->setFlashdata('error', 'Gagal mengubah password.');
        }

        return redirect()->to('/profile');
    }

    public function deleteAvatar()
    {
        // Check if user is logged in
        if (!$this->session->get('user_id')) {
            return $this->response->setJSON(['success' => false, 'message' => 'Unauthorized']);
        }

        $userId = $this->session->get('user_id');
        $user = $this->userModel->getUserById($userId);

        if ($user && $user['avatar']) {
            // Delete file
            $avatarPath = FCPATH . 'uploads/avatars/' . $user['avatar'];
            if (file_exists($avatarPath)) {
                unlink($avatarPath);
            }

            // Update database
            if ($this->userModel->update($userId, ['avatar' => null])) {
                // Update session
                $this->session->set('avatar', null);
                
                return $this->response->setJSON(['success' => true, 'message' => 'Avatar berhasil dihapus']);
            }
        }

        return $this->response->setJSON(['success' => false, 'message' => 'Gagal menghapus avatar']);
    }
}