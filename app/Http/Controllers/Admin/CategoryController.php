<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Models\category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(category $categories)
    {
        $categories = Category::paginate(15)-> Category::all();


        return view('admin.categories.index');

    }

 
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);
        
        return redirect()->route('admin.categories.index')->with('flash_message', 'カテゴリを登録しました。');

    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, category $categories)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $categories->save();
        
        return redirect()->route('categories.index')->with('flash_message', 'カテゴリを編集しました。');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(category $categories)
    {   
        $categories->delete();

        return redirect()->route('categories.index')->with('flash_message', 'カテゴリを削除しました。');

    }
}
