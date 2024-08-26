<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::paginate(10);
        return view('categories.index', compact('categories'));
    }
    public function create()
    {
        return view('categories.create');
    }
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:categories,name',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->save();

        return redirect()->route('home')->with('success', 'Category created successfully.');
    }
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = \Str::slug($request->name);
        $category->save();

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }
    public function bulkDelete(Request $request)
    {
        $categoryIds = $request->input('categories');

        if ($categoryIds) {
            $categoriesToDelete = Category::whereIn('id', $categoryIds)->get();

            foreach ($categoriesToDelete as $category) {
                if ($category->posts()->count() > 0) {
                    return redirect()->route('categories.index')->with('error', 'Category "' . $category->name . 'It cannot be deleted because it has associated posts.');
                }
            }
            Category::whereIn('id', $categoryIds)->delete();
        }
        return redirect()->route('categories.index')->with('success', 'Selected categories deleted successfully.');
    }
}
