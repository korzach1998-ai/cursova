<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Show the list of products
    public function index(Request $request)
    {
        $query = $request->input('query', '');
        $categoryId = $request->input('category_id', '');
    
        $productsQuery = Product::query();
    
        // Apply search filter by name and description
        if ($query) {
            $productsQuery->where('name', 'LIKE', "%{$query}%")
                          ->orWhere('description', 'LIKE', "%{$query}%");
        }
    
        // Apply category filter
        if ($categoryId) {
            $productsQuery->where('category_id', $categoryId);
        }
    
        // Paginate the products
        $products = $productsQuery->paginate(9);
    
        // Fetch categories for the filter box
        $categories = Category::all();
    
        return view('products.index', compact('products', 'query', 'categories', 'categoryId'));
    }
    

    // Show the form for creating a new product
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    // Store a new product
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        if (empty($validated['description'])) {
            $validated['description'] = 'No description available.';
        }

        // Handle file upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images/products', 'public');
        } else {
            $validated['image'] = 'images/products/shoes.png';
        }

        $validated['user_id'] = auth()->id();
        Product::create($validated);

        return redirect()->route('products.index')->with('success', 'Товар успішно створений!');
    }

    // Show the form for editing a product
    public function edit(Product $product)
    {
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));
    }

    // Update the product
    public function update(Request $request, Product $product)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
        ]);

        // Handle file upload
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('images/products', 'public');
        }

        $product->update($validated);

        return redirect()->route('products.index')->with('success', 'Товар успішно оновлений!');
    }

    // Delete the product
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index')->with('success', 'Товар успішно видалений!');
    }

    // Show a single product's details for editing and deletion
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
}
