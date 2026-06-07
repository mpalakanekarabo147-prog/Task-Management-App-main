<?php

namespace App\Http\Controllers;

use App\Models\CategoryKAL;
use Illuminate\Http\Request;

class CategoryControllerKAL extends Controller
{
    private CategoryKAL $categories;

    public function __construct(CategoryKAL $categories)
    {
        $this->categories = $categories;
    }

    public function index()
    {
        return view('categories.index', [
            'categories' => $this->categories->withCount('tasks')->orderBy('name')->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:80', 'unique:categories,name'],
            'color' => ['required', 'string', 'max:20'],
        ]);

        $this->categories->create($request->only('name', 'color'));

        return back()->with('status', 'Category created successfully.');
    }

    public function destroy(CategoryKAL $category)
    {
        $category->delete();

        return back()->with('status', 'Category deleted successfully.');
    }
}
