<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(News $newsModel) {
        $newsCollection = $newsModel->getNewsCollection();
        return view('news/index', [
            'newsCollection' => $newsCollection
        ]);
    }

    public function show(News $newsModel, int $id) {
        $news = $newsModel->getNews($id) ?? ['title' => '404 news not found'];
        return view('news/show', ['news' => $news]);
    }

    public function showByCategory(News $newsModel, int $id) {
        $foundNews = $newsModel->getNewsWithCategoryId($id);
        return view('news/index', [
            'newsCollection' => $foundNews
        ]);
    }
}
