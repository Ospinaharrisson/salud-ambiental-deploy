<?php

namespace App\Http\Livewire\User\News;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Shared\Content\Article;

class ArticlesList extends Component
{
    use WithPagination;

    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        return view('User.Content.News.Includes.news-list', [
            'articles' => Article::latest()->paginate(7)
        ]);
    }
}
