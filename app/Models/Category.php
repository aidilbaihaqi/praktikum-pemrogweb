<?php

namespace App\Models;

use CodeIgniter\Model;

class Category extends Model
{
    protected $table = 'categories';
    protected $primaryKey = 'id';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = false;
    protected $protectFields = true;
    protected $allowedFields = ['name', 'slug', 'description'];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat = 'datetime';
    protected $createdField = 'created_at';
    protected $updatedField = 'updated_at';

    // Validation
    protected $validationRules = [
        'name' => 'required|min_length[3]|max_length[100]',
        'slug' => 'required|min_length[3]|max_length[100]|is_unique[categories.slug,id,{id}]',
        'description' => 'permit_empty|max_length[500]'
    ];

    protected $validationMessages = [
        'name' => [
            'required' => 'Nama kategori harus diisi',
            'min_length' => 'Nama kategori minimal 3 karakter',
            'max_length' => 'Nama kategori maksimal 100 karakter'
        ],
        'slug' => [
            'required' => 'Slug kategori harus diisi',
            'min_length' => 'Slug kategori minimal 3 karakter',
            'max_length' => 'Slug kategori maksimal 100 karakter',
            'is_unique' => 'Slug kategori sudah digunakan'
        ],
        'description' => [
            'max_length' => 'Deskripsi kategori maksimal 500 karakter'
        ]
    ];

    protected $skipValidation = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert = ['generateSlug'];
    protected $beforeUpdate = ['generateSlug'];

    /**
     * Generate slug from name if slug is empty
     */
    protected function generateSlug(array $data)
    {
        if (isset($data['data']['name']) && empty($data['data']['slug'])) {
            $data['data']['slug'] = url_title($data['data']['name'], '-', true);
        }
        return $data;
    }

    /**
     * Get category with articles count
     */
    public function getCategoryWithArticlesCount($id = null)
    {
        $builder = $this->db->table($this->table);
        $builder->select('categories.*, COUNT(articles.id) as articles_count');
        $builder->join('articles', 'articles.category_id = categories.id', 'left');
        $builder->where('articles.status', 'published');
        
        if ($id !== null) {
            $builder->where('categories.id', $id);
            $builder->groupBy('categories.id');
            return $builder->get()->getRowArray();
        }
        
        $builder->groupBy('categories.id');
        return $builder->get()->getResultArray();
    }

    /**
     * Get category by slug
     */
    public function getCategoryBySlug($slug)
    {
        return $this->where('slug', $slug)->first();
    }

    /**
     * Get all categories for dropdown
     */
    public function getCategoriesForDropdown()
    {
        $categories = $this->findAll();
        $dropdown = [];
        
        foreach ($categories as $category) {
            $dropdown[$category['id']] = $category['name'];
        }
        
        return $dropdown;
    }
}