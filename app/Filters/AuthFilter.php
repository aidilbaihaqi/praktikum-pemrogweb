<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();
        
        // Check if user is not logged in
        if (!$session->get('user_id')) {
            // Redirect to login page with return URL
            $returnUrl = current_url();
            $session->setFlashdata('error', 'Anda harus login terlebih dahulu.');
            return redirect()->to('/login?return=' . urlencode($returnUrl));
        }
        
        // Check if user account is still active
        $userModel = new \App\Models\User();
        $user = $userModel->find($session->get('user_id'));
        
        if (!$user || !$user['is_active']) {
            $session->destroy();
            $session->setFlashdata('error', 'Akun Anda tidak aktif. Silakan hubungi administrator.');
            return redirect()->to('/login');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}