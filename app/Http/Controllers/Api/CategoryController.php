<?php

namespace App\Http\Controllers\Api;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ArticleResource;
use App\Http\Resources\CategoryResource;

class CategoryController extends Controller
{
    public function index(){
    
        $categories = Category::all();
        $data = CategoryResource::collection($categories);
        return response()->json($data);
    }

    public function getArticlesByCategory(Category $category)
    {
        $articles = $category->articles;

        return ArticleResource::collection($articles);
    }
        
}
