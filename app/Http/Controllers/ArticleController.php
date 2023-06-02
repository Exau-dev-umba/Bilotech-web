<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\ArticleResource;
use App\Http\Controllers\ImageController;
use App\Http\Resources\ArticleCollection;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $perPage = $request ->has('perPage') ? $request->query('perPage') : env('PER_PAGE');
        $articles = Article::paginate($perPage);
        $data = new ArticleCollection($articles);
        
        return response()->json($data);
    }

    public function search(Request $request){
        $query = $request->input('query');
        $articles = Article::where('content', 'LIKE', "%query%")->orWhere('title', 'LIKE', "%$query%")->get();
        return response()->json($articles);
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
    public function store(StoreArticleRequest $request)
    {

        $bodyStr = $request->getContent();
        $body = json_decode($bodyStr, true);
      
        $article = Article::create([
            'title' => $body["title"],
            'keyword' => $body["keyword"],
            'content' => $body["content"],
            'country' => $body["country"],
            'city' => $body["city"],
            'price' => $body["price"],
            'devise' => $body["devise"],
            'negociation' => $body["negociation"],
            'user_id' => Auth::user()->id
        
        ]); 


        if($article->save()){
            $data = new ArticleResource($article);
            return response()->json( [
                "id" => "$article->id"
            ], 201);
        }


        else{
            return response()->json([
                'success' => false,
                'errors' => $article->errors(),

            ], 500);
        }
    
}

    /**
     * Display the specified resource.
     */

     public function show(Article $article)
     {
        $data = new ArticleResource($article);
        return response()->json($data);
     }
  

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Article $article)
    {
        //
    }

    /**
     * Update the specified resource in storage.    
     */
    public function update(UpdateArticleRequest $request, Article $article)
    {
         
        $article = Article::find($article->id);
        $article->title = $request->input('title');
        $article->keyword = $request->input('keyword');
        $article->content = $request->input('content');
        $article->country = $request->input('country');
        $article->city = $request->input('city');
        $article->price = $request->input('price');
        $article->devise = $request->input('devise');
        $article->negociation = $request->input('negociation') ;
        $article->user_id = Auth::user()->id;
        
        if($article->save()){
            return response()->json($article, 200);
        }


        else{
            return response()->json([
                'success' => false,
                'errors' => $article->errors(),

            ], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json([
            '', 204
        ]);
    }
}
