<?php
namespace App\Controllers;

class Article extends BaseController 
{
  public function index(): string
  {
    $data['articles'] = [
			[
				'title' => 'Foo',
				'content' => 'Ini artikel tentang foo',
			],
			[
				'title' => 'Bar',
				'content' => 'Ini artikel tentang Bar',
			],
		];

    if(count($data['articles']) > 0)
    {
      return view('article', $data);
    }
    else
    {
      return view('article_not_found');
    }
  }
  public function show($title): string
  {
    $data['articles'] = [
			[
				'title' => 'Foo',
				'content' => 'Ini artikel tentang foo',
			],
			[
				'title' => 'Bar',
				'content' => 'Ini artikel tentang Bar',
			],
		];

    foreach($data['articles'] as $article)
    {
      if($article['title'] == $title)
      {
        $data['article'] = $article;
        return view('article_show', $data);
      }
    }
    return view('article_not_found');
  }
}