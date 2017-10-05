<?php

namespace App\Http\Controllers\Back;

use Illuminate\Http\Request;
use App\ {
    Http\Controllers\Controller,
    Http\Requests\CategoryRequest,
    Models\Category
};

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $categories = Category::oldest('title')->withCount('posts')->get();

        return view('back.categories.index', compact ('categories'));
    }

    /**
     * Show the form for creating a new categorie.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.categories.create');
    }

    /**
     * Store a newly created categorie in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        Category::create($request->all());

        return redirect(route('categories.index'))->with('category-ok', __('The category has been successfully created'));
    }

    /**
     * Show the form for editing the specified categorie.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        return view('back.categories.edit', compact ('category'));
    }

    /**
     * Update the specified categorie in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, Category $category)
    {
        $category->update($request->all());

        return redirect(route('categories.index'))->with('category-ok', __('The category has been successfully updated'));
    }

    /**
     * Remove the specified categorie from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete ();

        return response ()->json ();
    }
}
