<?php

namespace App\Controllers;

use App\Models\User;

class Auth extends BaseController
{
    protected $userModel;
    protected $session;

    public function __construct()
    {
        $this->userModel = new User();
        $this->session = \Config\Services::session();
    }

    public function login()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->get('user_id')) {
            return redirect()->to('/');
        }

        $data = [
            'meta' => [
                'title' => 'Login - BeritaCoding',
                'description' => 'Masuk ke akun BeritaCoding Anda'
            ],
            'validation' => \Config\Services::validation()
        ];

        return view('auth/login', $data);
    }

    public function attemptLogin()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->get('user_id')) {
            return redirect()->to('/');
        }

        $rules = [
            'login' => [
                'label' => 'Username/Email',
                'rules' => 'required'
            ],
            'password' => [
                'label' => 'Password',
                'rules' => 'required'
            ]
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $login = $this->request->getPost('login');
        $password = $this->request->getPost('password');
        $remember = $this->request->getPost('remember');

        $user = $this->userModel->authenticate($login, $password);

        if ($user) {
            // Set session data
            $sessionData = [
                'user_id' => $user['id'],
                'username' => $user['username'],
                'email' => $user['email'],
                'full_name' => $user['full_name'],
                'role' => $user['role'],
                'avatar' => $user['avatar'],
                'is_logged_in' => true
            ];

            $this->session->set($sessionData);

            // Set remember me cookie if checked
            if ($remember) {
                $cookieValue = base64_encode($user['id'] . ':' . $user['username']);
                setcookie('remember_user', $cookieValue, time() + (86400 * 30), '/'); // 30 days
            }

            $this->session->setFlashdata('success', 'Login berhasil! Selamat datang, ' . $user['full_name']);
            
            // Redirect to intended page or dashboard
            $redirectTo = $this->session->get('redirect_to') ?: '/';
            $this->session->remove('redirect_to');
            
            return redirect()->to($redirectTo);
        } else {
            $this->session->setFlashdata('error', 'Username/Email atau password salah');
            return redirect()->back()->withInput();
        }
    }



    public function logout()
    {
        // Remove remember me cookie
        if (isset($_COOKIE['remember_user'])) {
            setcookie('remember_user', '', time() - 3600, '/');
        }

        // Destroy session
        $this->session->destroy();

        $this->session->setFlashdata('success', 'Anda telah berhasil logout.');
        return redirect()->to('/');
    }

    public function checkRememberMe()
    {
        if (!$this->session->get('user_id') && isset($_COOKIE['remember_user'])) {
            $cookieValue = base64_decode($_COOKIE['remember_user']);
            $parts = explode(':', $cookieValue);
            
            if (count($parts) === 2) {
                $userId = $parts[0];
                $username = $parts[1];
                
                $user = $this->userModel->getUserById($userId);
                
                if ($user && $user['username'] === $username && $user['is_active']) {
                    // Auto login
                    $sessionData = [
                        'user_id' => $user['id'],
                        'username' => $user['username'],
                        'email' => $user['email'],
                        'full_name' => $user['full_name'],
                        'role' => $user['role'],
                        'avatar' => $user['avatar'],
                        'is_logged_in' => true
                    ];

                    $this->session->set($sessionData);
                    
                    // Update last login
                    $this->userModel->update($user['id'], ['last_login' => date('Y-m-d H:i:s')]);
                }
            }
        }
    }

    public function forgotPassword()
    {
        // Jika sudah login, redirect ke dashboard
        if ($this->session->get('user_id')) {
            return redirect()->to('/');
        }

        $data = [
            'meta' => [
                'title' => 'Lupa Password - BeritaCoding',
                'description' => 'Reset password akun BeritaCoding Anda'
            ],
            'validation' => \Config\Services::validation()
        ];

        return view('auth/forgot_password', $data);
    }

    public function resetPassword()
    {
        // Implementation for password reset
        // This would typically involve sending email with reset token
        $this->session->setFlashdata('info', 'Fitur reset password akan segera tersedia.');
        return redirect()->to('/login');
    }
}