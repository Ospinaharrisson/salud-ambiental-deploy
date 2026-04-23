<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Shared\Content\Article;

class ArticleRenderController extends Controller
{
    public function index() { 
        return view('User.Content.News.news-home');
    }

    public function show($id)
    {
        $article = Article::findOrFail($id);
        return view('User.Content.News.news-template', compact('article'));
    }
}
