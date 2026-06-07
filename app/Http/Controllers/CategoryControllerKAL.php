<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCategoryRequestKAL;
use App\Models\CategoryKAL;

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

    public function store(StoreCategoryRequestKAL $request)
    {
        $this->categories->create($request->validated());

        return back()->with('status', 'Category created successfully.');
    }

    public function destroy(CategoryKAL $category)
    {
        $category->delete();

        return back()->with('status', 'Category deleted successfully.');
    }
}
