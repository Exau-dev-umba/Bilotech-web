<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $categories = Category::all();

        return view('category.create', compact('categories'));
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

        $request->validate([
            'category_name' => 'required',
            'category_image' => 'required',
        ]);
        
        $category = new Category();
        $category->category_name = $request->input("category_name");
        $category->parent_id = $request->input("parent_id");

        if ($request->hasFile('category_image')) {
            $nameImage = date('YmdHis') . '.' . $request->category_image->extension();
            $image = $request->category_image->storeAs('images/categories', $nameImage, 'public');
            $category->category_image = $image; 
        }

        $category->save();

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
    public function update(Request $request, Category $category )
    {
    

        if ($request->hasFile('category_image')) {
            $nameImage = date('YmdHis') . '.' . $request->category_image->extension();
            $image = $request->category_image->storeAs('images/categories', $nameImage, 'public');
            Storage::delete($category->category_image);
        }

        else{
            $image = $category->category_image;
        }

        $category->update([
            "category_name"=> request("category_name"),
            "parent_id"=> request("parent_id"),
            "category_image"=> $image,
        ]);
        return redirect()->back()->with('success', 'La catégorie a été modifié avec succès.');
    }

    
    public function destroy(Category $category)
    {
        // Supprime la catégorie
        $category->delete();

        return redirect()->back()->with('success', 'La catégorie a été supprimée avec succès.');
    }
}
