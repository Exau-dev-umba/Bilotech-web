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
     * @OA\Get(
     *     path="/categories",
     *     summary="Obtenir la liste des catégories",
     *     @OA\Response(
     *         response=200,
     *         description="Succès - Liste des catégories",
     *    
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur interne du serveur"
     *     )
     * )
     */
    public function index()
    {
        $categories = Category::all();
        return view('category.index', compact('categories'));
    }

    
    public function create()
    {
        //
    }

    /**
     * @OA\Post(
     *     path="/categories",
     *     summary="Créer une nouvelle catégorie",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de la catégorie",
     *         @OA\JsonContent(
     *             @OA\Property(property="category_name", type="string"),
     *             @OA\Property(property="parent_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Catégorie créée avec succès"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur interne du serveur"
     *     )
     * )
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
     * @OA\Put(
     *     path="/categories/{category}",
     *     summary="Mettre à jour une catégorie",
     *     @OA\Parameter(
     *         name="category",
     *         in="path",
     *         description="Identifiant de la catégorie",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de la catégorie",
     *         @OA\JsonContent(
     *             @OA\Property(property="category_name", type="string"),
     *             @OA\Property(property="parent_id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Catégorie mise à jour avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Catégorie non trouvée"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur interne du serveur"
     *     )
     * )
     */
    public function update(Category $category, Request $request)
    {
        $request->validate([
            "category_name" => "required",
            "parent_id" => "required",
        ]);

        $category->update($request->all());
        return redirect()->back('category.index')->with('success', 'La catégorie a été modifié avec succès.');
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
