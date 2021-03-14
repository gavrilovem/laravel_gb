<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NewsCreateRequest;
use App\Http\Requests\NewsEditRequest;
use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param News $newsModel
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(News $newsModel)
    {
        return view('admin/news/index', [
            'newsCollection' => $newsModel->getNewsCollection(),
            'title' => 'Список новостей'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param Category $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create(Category $category)
    {
        return view('admin/news/create', ['categories' => $category->getCategories()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param NewsCreateRequest $request
     * @param News $newsModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(NewsCreateRequest $request, News $newsModel)
    {

        $data = $request->only(['title', 'description', 'text', 'category_id', 'is_private']);
        if (isset($data['is_private'])) {
            $data['is_private'] = '1';
        } else {
            $data['is_private'] = '0';
        }
        $res = $newsModel->create($data);

        if ($res) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно добавлена');
        }

        return back()->withInput()->with('errors', 'Не удалось добавить запись');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Category $categoriesModel
     * @param News $newsModel
     * @param int $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     */
    public function edit(Category $categoriesModel, News $newsModel, int $id)
    {
        if (!$news = $newsModel->getNews($id)) {
            return redirect()->route('admin.news.index');
        }
        return view('admin/news/edit', [
            'news' => $news,
            'categories' => $categoriesModel->getCategories()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param NewsEditRequest $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(NewsEditRequest $request, News $news)
    {
        $request->validated();

        $data = $request->only(['title', 'description', 'text', 'category_id', 'is_private']);
        if (isset($data['is_private'])) {
            $data['is_private'] = '1';
        } else {
            $data['is_private'] = '0';
        };

        $res = $news->fill($data)->save();
        if ($res) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно обновлена');
        }
        return back()->withInput()->with('errors', 'Обновить запись не удалось');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param News $newsModel
     * @param $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(News $newsModel, int $news)
    {
        $res = $newsModel->deleteRecord($news);
        if ($res) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно удалена');
        }
        return back()->withInput()->with('errors', 'Удалить запись не удалось');
    }
}
