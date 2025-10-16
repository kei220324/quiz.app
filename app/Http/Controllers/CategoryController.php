<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;
class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function top()
    {
        $category=Category::all();
        return view('admin.top')->with('categories',$category);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * // カテゴリー新規登録処理
     */
    public function store(StoreCategoryRequest $request)
    {

        $category=new Category();
        $category->name=$request->input('name');
        $category->description=$request->input('description');
        $category->save();
        return redirect()->route('admin.top')->with('success','カテゴリーを登録しました');

}

    // カテゴリー詳細画面表示
    public function show(Request $request, int $categoryId)
    {
    $category=Category::findOrFail($categoryId);
    return view('admin.categories.show') ->with('category',$category);
    }

    /**
     * カテゴリー編集画面表示
     */
    public function edit(Request $request, int $categoryId)
    {
    $category=Category::findOrFail($categoryId);
     return view('admin.categories.edit') ->with('category',$category);

    }

    /**
     * カテゴリー更新処理
     */
    public function update(UpdateCategoryRequest $request,int $categoryId)
    {
        $category=Category::findOrFail($categoryId);
        $category->name=$request->input('name');
        $category->description=$request->input('description');
        $category->save();
         return redirect()->route('admin.categories.show', ['categoryId' => $category->id])
         ->with('success', 'カテゴリーを更新しました');
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
