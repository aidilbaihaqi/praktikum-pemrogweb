<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Category;
use CodeIgniter\HTTP\RedirectResponse;

class Dashboard extends BaseController
{
    protected $articleModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->articleModel = new Article();
        $this->categoryModel = new Category();
    }

    /**
     * Dashboard index - show article management
     */
    public function index(): string
    {
        // Get articles with pagination
        $perPage = 10;
        $page = $this->request->getVar('page') ?? 1;
        $offset = ($page - 1) * $perPage;
        
        // Get search and filter parameters
        $search = $this->request->getVar('search');
        $status = $this->request->getVar('status');
        $category = $this->request->getVar('category');
        
        $builder = $this->articleModel->builder();
        $builder->select('articles.*, categories.name as category_name');
        $builder->join('categories', 'categories.id = articles.category_id', 'left');
        
        // Apply filters
        if ($search) {
            $builder->groupStart();
            $builder->like('articles.title', $search);
            $builder->orLike('articles.content', $search);
            $builder->orLike('articles.author', $search);
            $builder->groupEnd();
        }
        
        if ($status && $status !== 'all') {
            $builder->where('articles.status', $status);
        }
        
        if ($category && $category !== 'all') {
            $builder->where('articles.category_id', $category);
        }
        
        $builder->orderBy('articles.created_at', 'DESC');
        
        // Get total count for pagination
        $totalArticles = $builder->countAllResults(false);
        
        // Get articles for current page
        $articles = $builder->limit($perPage, $offset)->get()->getResultArray();
        
        // Get categories for filter dropdown
        $categories = $this->categoryModel->findAll();
        
        // Calculate pagination
        $totalPages = ceil($totalArticles / $perPage);
        
        // Get statistics
        $stats = [
            'total' => $this->articleModel->countAllResults(),
            'published' => $this->articleModel->where('status', 'published')->countAllResults(),
            'draft' => $this->articleModel->where('status', 'draft')->countAllResults(),
            'archived' => $this->articleModel->where('status', 'archived')->countAllResults()
        ];
        
        $data = [
            'meta' => [
                'title' => 'Dashboard - Kelola Artikel',
                'description' => 'Dashboard untuk mengelola artikel di BeritaCoding'
            ],
            'articles' => $articles,
            'categories' => $categories,
            'stats' => $stats,
            'pagination' => [
                'current_page' => $page,
                'total_pages' => $totalPages,
                'per_page' => $perPage,
                'total_items' => $totalArticles
            ],
            'filters' => [
                'search' => $search,
                'status' => $status,
                'category' => $category
            ]
        ];
        
        return view('dashboard/index', $data);
    }

    /**
     * Show create article form
     */
    public function create(): string
    {
        $categories = $this->categoryModel->findAll();
        
        $data = [
            'meta' => [
                'title' => 'Tambah Artikel Baru',
                'description' => 'Form untuk menambah artikel baru'
            ],
            'categories' => $categories
        ];
        
        return view('dashboard/create', $data);
    }

    /**
     * Store new article
     */
    public function store(): RedirectResponse
    {
        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'content' => 'required|min_length[50]',
            'excerpt' => 'permit_empty|max_length[500]',
            'category_id' => 'permit_empty|integer',
            'author' => 'required|min_length[3]|max_length[100]',
            'tags' => 'permit_empty',
            'status' => 'required|in_list[draft,published,archived]',
            'image' => 'permit_empty|uploaded[image]|max_size[image,2048]|is_image[image]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'excerpt' => $this->request->getPost('excerpt'),
            'category_id' => $this->request->getPost('category_id') ?: null,
            'author' => $this->request->getPost('author'),
            'tags' => $this->request->getPost('tags'),
            'status' => $this->request->getPost('status')
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/articles', $newName);
            $data['image'] = $newName;
        }

        if ($this->articleModel->insert($data)) {
            return redirect()->to('/dashboard')->with('success', 'Artikel berhasil ditambahkan!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan artikel!');
        }
    }

    /**
     * Show edit article form
     */
    public function edit($id): string
    {
        $article = $this->articleModel->find($id);
        
        if (!$article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan');
        }
        
        $categories = $this->categoryModel->findAll();
        
        $data = [
            'meta' => [
                'title' => 'Edit Artikel - ' . $article['title'],
                'description' => 'Form untuk mengedit artikel'
            ],
            'article' => $article,
            'categories' => $categories
        ];
        
        return view('dashboard/edit', $data);
    }

    /**
     * Update article
     */
    public function update($id): RedirectResponse
    {
        $article = $this->articleModel->find($id);
        
        if (!$article) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Artikel tidak ditemukan');
        }

        $rules = [
            'title' => 'required|min_length[5]|max_length[255]',
            'content' => 'required|min_length[50]',
            'excerpt' => 'permit_empty|max_length[500]',
            'category_id' => 'permit_empty|integer',
            'author' => 'required|min_length[3]|max_length[100]',
            'tags' => 'permit_empty',
            'status' => 'required|in_list[draft,published,archived]',
            'image' => 'permit_empty|uploaded[image]|max_size[image,2048]|is_image[image]'
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->withInput()->with('validation', $this->validator);
        }

        $data = [
            'title' => $this->request->getPost('title'),
            'content' => $this->request->getPost('content'),
            'excerpt' => $this->request->getPost('excerpt'),
            'category_id' => $this->request->getPost('category_id') ?: null,
            'author' => $this->request->getPost('author'),
            'tags' => $this->request->getPost('tags'),
            'status' => $this->request->getPost('status')
        ];

        // Handle image upload
        $image = $this->request->getFile('image');
        if ($image && $image->isValid() && !$image->hasMoved()) {
            // Delete old image if exists
            if ($article['image'] && file_exists(ROOTPATH . 'public/uploads/articles/' . $article['image'])) {
                unlink(ROOTPATH . 'public/uploads/articles/' . $article['image']);
            }
            
            $newName = $image->getRandomName();
            $image->move(ROOTPATH . 'public/uploads/articles', $newName);
            $data['image'] = $newName;
        }

        if ($this->articleModel->update($id, $data)) {
            return redirect()->to('/dashboard')->with('success', 'Artikel berhasil diperbarui!');
        } else {
            return redirect()->back()->withInput()->with('error', 'Gagal memperbarui artikel!');
        }
    }

    /**
     * Delete article
     */
    public function delete($id): RedirectResponse
    {
        $article = $this->articleModel->find($id);
        
        if (!$article) {
            return redirect()->to('/dashboard')->with('error', 'Artikel tidak ditemukan!');
        }

        // Delete image if exists
        if ($article['image'] && file_exists(ROOTPATH . 'public/uploads/articles/' . $article['image'])) {
            unlink(ROOTPATH . 'public/uploads/articles/' . $article['image']);
        }

        if ($this->articleModel->delete($id)) {
            return redirect()->to('/dashboard')->with('success', 'Artikel berhasil dihapus!');
        } else {
            return redirect()->to('/dashboard')->with('error', 'Gagal menghapus artikel!');
        }
    }

    /**
     * Toggle article status (quick publish/unpublish)
     */
    public function toggleStatus($id): RedirectResponse
    {
        $article = $this->articleModel->find($id);
        
        if (!$article) {
            return redirect()->to('/dashboard')->with('error', 'Artikel tidak ditemukan!');
        }

        $newStatus = $article['status'] === 'published' ? 'draft' : 'published';
        
        if ($this->articleModel->update($id, ['status' => $newStatus])) {
            $message = $newStatus === 'published' ? 'Artikel berhasil dipublikasikan!' : 'Artikel berhasil dijadikan draft!';
            return redirect()->to('/dashboard')->with('success', $message);
        } else {
            return redirect()->to('/dashboard')->with('error', 'Gagal mengubah status artikel!');
        }
    }
}