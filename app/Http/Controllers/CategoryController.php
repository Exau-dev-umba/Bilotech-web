<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\CategoryResource;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $category = Category::create([
            'category_name' => $request->input("category_name"),
            'parent_id' => $request->input("parent_id"),
        ]); 

        return redirect()->route('category.index')->with('success', 'La catégorie a été créée avec succès.');

       
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function update(Category $category, Request $request)
    {
        $request->validate([
            "category_name" => "required",
            "parent_id" => "required",
        ]);

        $category->update($request->all());
        return redirect()->back()->with('success', 'La catégorie a été modifié avec succès.');
    }

    /**
     * Update the specified resource in storage.
     */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
    }
}
