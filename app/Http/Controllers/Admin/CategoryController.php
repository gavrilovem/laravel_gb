<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryCreateRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Category $categoryModel
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function index(Category $categoryModel)
    {
        return view('admin/news/categories/index', [
            'categories' => $categoryModel->getCategories(),
            'title' => 'Список категорий'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin/news/categories/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CategoryCreateRequest $request
     * @param Category $categoryModel
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(CategoryCreateRequest $request, Category $categoryModel)
    {
        $request->validated();

        $data = $request->only(['name']);
        $res = $categoryModel->create($data);

        if ($res) {
            return redirect()->route('admin.category.index')
                ->with('success', __('messages.category.create.success'));
        }

        return back()->withInput()->with('errors', __('messages.category.create.error'));
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
     * @param Category $categoryModel
     * @param int $category
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\Response
     */
    public function edit(Category $categoryModel, int $category)
    {
        return view('admin/news/categories/edit', ['category' => $categoryModel->getCategory($category)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param CategoryCreateRequest $request
     * @param Category $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryCreateRequest $request, Category $category)
    {
        $request->validated();

        $data = $request->only('name');
        $res = $category->fill($data)->save();

        if ($res) {
            return redirect()->route('admin.category.index')
                ->with('success', trans('messages.category.update.success'));
        }

        return back()->withInput()->with('errors', __('messages.category.update.error'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Category $categoryModel
     * @param int $category
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy(Category $categoryModel, int $category)
    {
        $res = $categoryModel->deleteRecord($category);
        if ($res) {
            return redirect()->route('admin.category.index')
                ->with('success', __('messages.category.delete.success'));
        }
        return back()->withInput()->with('errors', __('messages.category.delete.error'));
    }
}
