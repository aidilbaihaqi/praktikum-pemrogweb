<?php

namespace App\Models;

use CodeIgniter\Model;

class Article extends Model
{
    protected $table = 'articles';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = [
        'title', 'slug', 'content', 'excerpt', 'image', 
        'category_id', 'author', 'tags', 'status', 
        'views', 'published_at'
    ];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'title' => 'required|min_length[5]|max_length[255]',
        'slug' => 'required|min_length[5]|max_length[255]|is_unique[articles.slug,id,{id}]',
        'content' => 'required|min_length[50]',
        'excerpt' => 'permit_empty|max_length[500]',
        'image' => 'permit_empty|max_length[255]',
        'category_id' => 'permit_empty|integer|is_not_unique[categories.id]',
        'author' => 'required|min_length[3]|max_length[100]',
        'tags' => 'permit_empty',
        'status' => 'required|in_list[draft,published,archived]',
        'published_at' => 'permit_empty|valid_date'
    ];

    protected $validationMessages = [
        'title' => [
            'required' => 'Judul artikel harus diisi',
            'min_length' => 'Judul artikel minimal 5 karakter',
            'max_length' => 'Judul artikel maksimal 255 karakter'
        ],
        'slug' => [
            'required' => 'Slug artikel harus diisi',
            'min_length' => 'Slug artikel minimal 5 karakter',
            'max_length' => 'Slug artikel maksimal 255 karakter',
            'is_unique' => 'Slug artikel sudah digunakan'
        ],
        'content' => [
            'required' => 'Konten artikel harus diisi',
            'min_length' => 'Konten artikel minimal 50 karakter'
        ],
        'excerpt' => [
            'max_length' => 'Ringkasan artikel maksimal 500 karakter'
        ],
        'category_id' => [
            'integer' => 'ID kategori harus berupa angka',
            'is_not_unique' => 'Kategori yang dipilih tidak valid'
        ],
        'author' => [
            'required' => 'Nama penulis harus diisi',
            'min_length' => 'Nama penulis minimal 3 karakter',
            'max_length' => 'Nama penulis maksimal 100 karakter'
        ],
        'status' => [
            'required' => 'Status artikel harus dipilih',
            'in_list' => 'Status artikel tidak valid'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['generateSlug', 'generateExcerpt', 'setPublishedAt'];
    protected $beforeUpdate = ['generateSlug', 'generateExcerpt', 'setPublishedAt'];

    /**
     * Generate slug from title if slug is empty
     */
    protected function generateSlug(array $data)
    {
        if (isset($data['data']['title']) && empty($data['data']['slug'])) {
            $data['data']['slug'] = url_title($data['data']['title'], '-', true);
        }
        return $data;
    }

    /**
     * Generate excerpt from content if excerpt is empty
     */
    protected function generateExcerpt(array $data)
    {
        if (isset($data['data']['content']) && empty($data['data']['excerpt'])) {
            $content = strip_tags($data['data']['content']);
            $data['data']['excerpt'] = character_limiter($content, 200);
        }
        return $data;
    }

    /**
     * Set published_at when status is published
     */
    protected function setPublishedAt(array $data)
    {
        if (isset($data['data']['status']) && $data['data']['status'] === 'published') {
            if (empty($data['data']['published_at'])) {
                $data['data']['published_at'] = date('Y-m-d H:i:s');
            }
        }
        return $data;
    }

    /**
     * Get published articles with category
     */
    public function getPublishedArticles($limit = null, $offset = 0)
    {
        $builder = $this->db->table($this->table);
        $builder->select('articles.*, categories.name as category_name, categories.slug as category_slug');
        $builder->join('categories', 'categories.id = articles.category_id', 'left');
        $builder->where('articles.status', 'published');
        $builder->orderBy('articles.published_at', 'DESC');
        
        if ($limit !== null) {
            $builder->limit($limit, $offset);
        }
        
        return $builder->get()->getResultArray();
    }

    /**
     * Get article by slug with category
     */
    public function getArticleBySlug($slug)
    {
        $builder = $this->db->table($this->table);
        $builder->select('articles.*, categories.name as category_name, categories.slug as category_slug');
        $builder->join('categories', 'categories.id = articles.category_id', 'left');
        $builder->where('articles.slug', $slug);
        $builder->where('articles.status', 'published');
        
        return $builder->get()->getRowArray();
    }

    /**
     * Get articles by category
     */
    public function getArticlesByCategory($categorySlug, $limit = null, $offset = 0)
    {
        $builder = $this->db->table($this->table);
        $builder->select('articles.*, categories.name as category_name, categories.slug as category_slug');
        $builder->join('categories', 'categories.id = articles.category_id', 'inner');
        $builder->where('categories.slug', $categorySlug);
        $builder->where('articles.status', 'published');
        $builder->orderBy('articles.published_at', 'DESC');
        
        if ($limit !== null) {
            $builder->limit($limit, $offset);
        }
        
        return $builder->get()->getResultArray();
    }

    /**
     * Search articles
     */
    public function searchArticles($keyword, $limit = null, $offset = 0)
    {
        $builder = $this->db->table($this->table);
        $builder->select('articles.*, categories.name as category_name, categories.slug as category_slug');
        $builder->join('categories', 'categories.id = articles.category_id', 'left');
        $builder->where('articles.status', 'published');
        $builder->groupStart();
        $builder->like('articles.title', $keyword);
        $builder->orLike('articles.content', $keyword);
        $builder->orLike('articles.tags', $keyword);
        $builder->groupEnd();
        $builder->orderBy('articles.published_at', 'DESC');
        
        if ($limit !== null) {
            $builder->limit($limit, $offset);
        }
        
        return $builder->get()->getResultArray();
    }

    /**
     * Get popular articles (by views)
     */
    public function getPopularArticles($limit = 5)
    {
        $builder = $this->db->table($this->table);
        $builder->select('articles.*, categories.name as category_name, categories.slug as category_slug');
        $builder->join('categories', 'categories.id = articles.category_id', 'left');
        $builder->where('articles.status', 'published');
        $builder->orderBy('articles.views', 'DESC');
        $builder->orderBy('articles.published_at', 'DESC');
        $builder->limit($limit);
        
        return $builder->get()->getResultArray();
    }

    /**
     * Get recent articles
     */
    public function getRecentArticles($limit = 5)
    {
        return $this->getPublishedArticles($limit);
    }

    /**
     * Increment article views
     */
    public function incrementViews($id)
    {
        $builder = $this->db->table($this->table);
        $builder->set('views', 'views + 1', false);
        $builder->where('id', $id);
        return $builder->update();
    }

    /**
     * Get articles count by status
     */
    public function getArticlesCountByStatus($status = 'published')
    {
        return $this->where('status', $status)->countAllResults();
    }

    /**
     * Get related articles (same category, exclude current article)
     */
    public function getRelatedArticles($categoryId, $currentArticleId, $limit = 3)
    {
        $builder = $this->db->table($this->table);
        $builder->select('articles.*, categories.name as category_name, categories.slug as category_slug');
        $builder->join('categories', 'categories.id = articles.category_id', 'left');
        $builder->where('articles.category_id', $categoryId);
        $builder->where('articles.id !=', $currentArticleId);
        $builder->where('articles.status', 'published');
        $builder->orderBy('articles.published_at', 'DESC');
        $builder->limit($limit);
        
        return $builder->get()->getResultArray();
    }
}