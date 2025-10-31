<?php
namespace App\Controllers;

use App\Models\Article as ArticleModel;
use App\Models\Category;

class Article extends BaseController 
{
    protected $articleModel;
    protected $categoryModel;

    public function __construct()
    {
        $this->articleModel = new ArticleModel();
        $this->categoryModel = new Category();
    }

    public function index(): string
    {
        // Ambil semua artikel yang dipublish dari database
        $articles = $this->articleModel->getPublishedArticles();
        
        $data = [
            'meta' => [
                'title' => 'Artikel - BeritaCoding',
                'description' => 'Kumpulan artikel dan tutorial coding terbaru untuk developer Indonesia'
            ],
            'articles' => $articles
        ];

        if(count($articles) > 0)
        {
            return view('article', $data);
        }
        else
        {
            return view('article_not_found');
        }
    }

    public function show($slug): string
    {
        // Cari artikel berdasarkan slug
        $article = $this->articleModel->getArticleBySlug($slug);

        if($article)
        {
            // Increment views
            $this->articleModel->incrementViews($article['id']);
            
            // Get related articles
            $relatedArticles = [];
            if($article['category_id']) {
                $relatedArticles = $this->articleModel->getRelatedArticles(
                    $article['category_id'], 
                    $article['id'], 
                    3
                );
            }

            $data = [
                'meta' => [
                    'title' => $article['title'] . ' - BeritaCoding',
                    'description' => $article['excerpt'] ?: character_limiter(strip_tags($article['content']), 160)
                ],
                'article' => $article,
                'relatedArticles' => $relatedArticles
            ];
            
            return view('article_detail', $data);
        }
        
        return view('article_not_found');
    }

    public function category($categorySlug): string
    {
        // Cari kategori berdasarkan slug
        $category = $this->categoryModel->getCategoryBySlug($categorySlug);
        
        if(!$category) {
            return view('article_not_found');
        }

        // Ambil artikel berdasarkan kategori
        $articles = $this->articleModel->getArticlesByCategory($categorySlug);
        
        $data = [
            'meta' => [
                'title' => 'Kategori: ' . $category['name'] . ' - BeritaCoding',
                'description' => $category['description'] ?: 'Artikel dalam kategori ' . $category['name']
            ],
            'category' => $category,
            'articles' => $articles
        ];

        return view('article_category', $data);
    }

    public function search(): string
    {
        $keyword = $this->request->getGet('q');
        $articles = [];
        
        if($keyword) {
            $articles = $this->articleModel->searchArticles($keyword);
        }
        
        $data = [
            'meta' => [
                'title' => 'Pencarian: ' . ($keyword ?: '') . ' - BeritaCoding',
                'description' => 'Hasil pencarian artikel untuk: ' . ($keyword ?: '')
            ],
            'keyword' => $keyword,
            'articles' => $articles
        ];

        return view('article_search', $data);
    }
}