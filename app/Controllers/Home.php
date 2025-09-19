<?php

namespace App\Controllers;

class Home extends BaseController
{
    public function index(): string
    {
        return view('home');
    }
    public function about(): string
    {
        return view('about');
    }
    public function contact(): string
    {
        return view('contact');
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
            return view('contact', [
                'validation' => $validation,
                'input' => $this->request->getPost()
            ]);
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
}
