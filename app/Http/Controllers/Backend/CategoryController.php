<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    //
    public function index()
    {
        $categorys = Category::with('product')->paginate(5);
        return view('admin.category.index', compact('categorys'));
    }
    public function create()
    {
        return view('admin.category.create');
    }
    public function store(Request $request)
    {
        Validator::make($request->all(), [
            'name' => 'required',
        ])->validate();
        Category::create([
            'name' => $request->name,
        ]);
        return redirect()->route('admin.page.category.index')->with('success', 'Add Category Success');
    }
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('admin.category.create', compact('category'));
    }
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        $category->update($request->all());
        return redirect()->route('admin.page.category.index')->with('success', 'Update Category Success');
    }
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->route('admin.page.category.index')->with('success', 'Delete Category Success');
    }
}
