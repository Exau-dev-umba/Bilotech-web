<?php

namespace App\Http\Controllers;

use App\Models\Article;
use Illuminate\Http\Request;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $articles = Article::paginate(25);
        return view('article.index', compact('articles'));
    }

  

   
    public function destroy(Article $article)
    {
        $article->delete();

         return redirect()->back()->with('success', 'L\'article été supprimée avec succès.');
    }
}
