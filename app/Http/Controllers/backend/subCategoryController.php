<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\subCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class subCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $subcategories = subCategory::with('category')->latest()->get();
        return view('backend.admin.subcategory.index', compact('subcategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::latest()->get();
        return view('backend.admin.subcategory.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories,name',
            'slug' => 'required|unique:sub_categories,slug',
            'category' => 'required|exists:categories,id',
        ]);

        $subcategory = new subCategory();
        $subcategory->name = $request->name;
        $subcategory->slug = $request->slug;
        $subcategory->category_id = $request->category;
        $subcategory->save();

        return redirect()->route('admin.subcategories.index')->with('success', 'Sub Category created successfully.');
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
        $subcategory = subCategory::findOrFail($id);
        $categories = Category::latest()->get();
        return view('backend.admin.subcategory.edit', compact('subcategory', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => 'required|unique:sub_categories,name,' . $id,
            'slug' => 'required|unique:sub_categories,slug,' . $id,
            'category' => 'required|exists:categories,id',
        ]);

        $subcategory = subCategory::findOrFail($id);
        $subcategory->name = $request->name;
        $subcategory->slug = $request->slug;
        $subcategory->category_id = $request->category;
        $subcategory->save();

        return redirect()->route('admin.subcategories.index')->with('success', 'Sub Category updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $subcategory = subCategory::findOrFail($id);
        $subcategory->delete();

        return redirect()->route('admin.subcategories.index')->with('success', 'Sub Category deleted successfully.');
    }
}
