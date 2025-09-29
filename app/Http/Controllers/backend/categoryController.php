<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.admin.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('backend.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userId = Auth::user()->id;

        $request->validate([
            'name' => 'required|unique:categories,name',
            'slug' => 'required|unique:categories,slug, ' . $userId,
            'photo' => 'nullable|image|max:2048',
        ]);

        $category = new Category();
        $category->name = $request->name;
        $category->slug = $request->slug;
        if ($request->hasFile('photo')) {
            $imagePath = $request->file('photo')->store('upload/categories', 'public');
            $category->image = $imagePath;
        }
        $category->save();

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('backend.admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:categories,name,' . $id,
            'slug' => 'required|unique:categories,slug,' . $id,
            'photo' => 'nullable|image|max:2048',
        ]);

        $category = Category::findOrFail($id);
        $category->name = $request->name;
        $category->slug = $request->slug;

        if ($request->hasFile('photo')) {
            // If a new image is uploaded, delete the old image
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
            $imagePath = $request->file('photo')->store('upload/categories', 'public');
            $category->image = $imagePath;
        } else {
            // If no new image is uploaded, retain the existing image
            $category['image'] = $category->image;
        }
        $category->save();
        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        if ($category->image) Storage::disk('public')->delete($category->image);
        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
