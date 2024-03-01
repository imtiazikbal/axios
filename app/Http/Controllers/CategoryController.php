<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{

    public function index()
    {
        $categories = Category::all();
        return response()->json($categories);
    }
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
        ]);
        Category::create($validate);
        return response()->json([
            'message' => 'Category created successfully',
            'status' => 200,
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json([
            'message' => 'Category deleted successfully',
            'status' => 200,
        ]);
    }
    public function show(Category $category)
    {
        return $category;
    }
    public function update(Request $request, Category $category)
    {
        $validate = $request->validate([
            'name' => 'required|max:255',
        ]);
        $category->update($validate);
        return response()->json([
            'message' => 'Category created successfully',
            'status' => 200,
        ]);
    }
}
