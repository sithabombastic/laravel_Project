<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('created_at', 'desc')->get();
        return view('categories.category', compact('categories'));
    }

    public function create()
    {
        return view('categories.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            [
                'sku' => 'required|unique:categories,sku',
                'barcode' => 'required',
                'name_en' => 'required',
                'name_kh' => 'required',
                'price' => 'required|numeric',
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            ],
            [
                'sku.unique' => 'The SKU has Already Exists.',
            ]
        );

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = str_replace('\\', '/', $path);
        }

        Category::create($validated);

        return redirect()->route('categories.index')->with('success', 'Item Added Successfully!');
    }

    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        $category->image_exists = $category->image && Storage::disk('public')->exists($category->image);

        return view('categories.show', compact('category'));
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        $category->image_exists = $category->image && Storage::disk('public')->exists($category->image);

        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category)
    {
        $validated = $request->validate([
            'sku' => 'required|unique:categories,sku,' . $category->id,
            'barcode' => 'required',
            'name_en' => 'required|string|max:255',
            'name_kh' => 'required|string|max:255',
            'price' => 'required|numeric',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('image')) {
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }

            $path = $request->file('image')->store('categories', 'public');
            $validated['image'] = str_replace('\\', '/', $path);
        }

        $category->update($validated);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully.');
    }

    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return redirect()->route('categories.index')->with('success', 'Item deleted successfully.');
    }
}
