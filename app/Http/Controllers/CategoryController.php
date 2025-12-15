<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    // Show the list of categories
    public function index(Request $request)
    {
        $query = $request->input('query', '');  // Get search query
        $categories = Category::where('name', 'LIKE', "%{$query}%")
                            ->orWhere('description', 'LIKE', "%{$query}%")
                            ->paginate(9);

        return view('categories.index', compact('categories', 'query'));
    }

    // Show the form for creating a new category
    public function create()
    {
        return view('categories.create');
    }

    // Store a new category
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $validated['description'] = $validated['description'] ?? 'Відсутній опис';

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Категорія успішно створена!');
    }

    // Show the form for editing a category
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    // Update the category
    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
        ]);

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Категорія успішно оновлена!');
    }

    // Delete the category
    public function destroy(Category $category)
    {
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Категорія успішно видалена!');
    }
}

