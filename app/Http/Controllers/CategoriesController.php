<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Word;
use Illuminate\Http\Request;

class CategoriesController extends Controller
{
    public function index()
    {
        return redirect()->to('/');
    }

    public function main()
    {
        $categories = Category::select('id', 'name')->where('user_id', auth()->user()->id)->get();
        return view('main')->with(compact('categories'));
    }

    public function create()
    {
        return abort(404);
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = new Category();
        $category->name = $request->all()['name'];
        $category->user_id = auth()->user()->id;
        if ($category->save()) {
            return response($category, 200);
        } else {
            return response(false, 400);
        }
    }

    public function show($id)
    {
        $category = Category::findOrFail($id);
        $words = $category->words;
        return view('category')->with(compact('category', 'words', 'id'));
    }

    public function edit($id)
    {
        return abort(404);
    }

    public function update(UpdateCategoryRequest $request, $id)
    {
        $category = Category::findOrFail($id);
        $category->name = $request->name;
        if ($category->save()) {
            return response(true, 200);
        } else {
            return response(false, 400);
        }
    }

    public function destroy(DeleteCategoryRequest $request, $id)
    {
        if (Category::destroy($id)) {
            return response(true, 200);
        } else {
            return response(false, 400);
        }
    }
}
