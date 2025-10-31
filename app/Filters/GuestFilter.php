<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class GuestFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        $session = \Config\Services::session();
        
        // Check if user is already logged in
        if ($session->get('user_id')) {
            // Check if there's a return URL in the session
            $returnUrl = $session->get('return_url');
            
            if ($returnUrl) {
                $session->remove('return_url');
                return redirect()->to($returnUrl);
            }
            
            // Default redirect to home page
            $session->setFlashdata('info', 'Anda sudah login.');
            return redirect()->to('/');
        }
    }

    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        // Do nothing
    }
}