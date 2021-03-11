<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
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
     * @param \Illuminate\Http\Request $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'text' => 'required',
            'category_id' => 'required'
        ]);

        $data = $request->only(['title', 'description', 'text', 'category_id', 'is_private']);
        if (isset($data['is_private'])) {
            $data['is_private'] = '1';
        } else {
            $data['is_private'] = '0';
        }
        $res = $news->create($data);

        if ($res) {
            return redirect()->route('admin.news.index')
                ->with('success', 'Запись успешно добавлена');
        }

        return back()->withInput()->with('errors', 'Не удалось добавить запись');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Category $categoriesModel, News $newsModel, int $id)
    {
        return view('admin/news/edit', [
            'news' => $newsModel->getNews($id),
            'categories' => $categoriesModel->getCategories()
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param News $news
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'text' => 'required',
            'category_id' => 'required',
        ]);

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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

    }
}
