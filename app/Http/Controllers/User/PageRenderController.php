<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Services\User\Page\PageRenderService;

class PageRenderController extends Controller
{
    protected $pageService;

    public function __construct(PageRenderService $pageService)
    {
        $this->pageService = $pageService;
    }

    public function show($id, $slug)
    {
        $data = $this->pageService->getPageData($id, $slug);
        return view('User.Content.Page.Module.Template.page-template', $data);
    }

    public function showRecords($id, $slug)
    {
        $data = $this->pageService->getRecordsPageData($id, $slug);
        return view('User.Content.Page.Module.Records.records-template', $data);
    }

    public function showQuestions()
    {
        $data = $this->pageService->getQuestionsModules();
        return view('User.Content.Page.Questions.page-questions', $data);
    }

    public function showAccredited()
    {
        $data = $this->pageService->getEstablishmentsByCategory('accredited');
        return view('User.Content.Page.Establishments.page-establishments', $data);
    }
    
    public function showFavorable()
    {
        $data = $this->pageService->getEstablishmentsByCategory('favorable');
        return view('User.Content.Page.Establishments.page-establishments', $data);
    }

    public function showHomePage($id)
    {
        $data = $this->pageService->getHomePageData($id);
        return view('User.Content.Page.Home.page-home', $data);
    }
}