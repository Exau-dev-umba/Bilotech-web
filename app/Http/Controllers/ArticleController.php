<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Visites_articles;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use App\Http\Resources\ArticleResource;
use Illuminate\Support\Facades\Session;
use App\Http\Controllers\ImageController;
use App\Http\Resources\ArticleCollection;
use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;

class ArticleController extends Controller
{
        
    /**
     * @OA\Get(
     *     path="/articles",
     *     summary="Récupérer la liste des articles",
     *     @OA\Parameter(
     *         name="perPage",
     *         in="query",
     *         description="Nombre d'articles par page",
     *         required=false,
     *         @OA\Schema(type="integer", default=10)
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Succès - Liste des articles récupérée",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="current_page", type="integer"),
     *             @OA\Property(property="per_page", type="integer"),
     *             @OA\Property(property="total", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur interne du serveur"
     *     )
     * )
     */

    public function index(Request $request)
    {
        $perPage = $request ->has('perPage') ? $request->query('perPage') : env('PER_PAGE');
        $articles = Article::paginate($perPage);
        $data = new ArticleCollection($articles);
        
        // return view('articles.index')->with('articles', $articles);
        return response()->json($data);
    }

    /**
     * @OA\Get(
     *     path="/articles/search",
     *     summary="Rechercher des articles",
     *     @OA\Parameter(
     *         name="query",
     *         in="query",
     *         description="Terme de recherche",
     *         required=true,
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Succès - Liste des articles correspondant à la recherche",   
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur interne du serveur"
     *     )
     * )
     */

    public function search(Request $request){
        $query = $request->input('query');
        $articles = Article::where('content', 'LIKE', "%query%")->orWhere('title', 'LIKE', "%$query%")->get();
        return response()->json($articles);
    }

    public function similar($id){
        $articles = Article::findOrFail($id);

        $similarArticles = Article::where('category_id', $articles->category_id)
        ->where('id', '!=', $id )
        ->limit(5)
        ->get();

        return response()->json($similarArticles);
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

    /**
     * @OA\Post(
     *     path="/articles",
     *     summary="Créer un nouvel article",
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de l'article",
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Article créé avec succès",
     *         @OA\JsonContent(
     *             @OA\Property(property="id", type="integer")
     *         )
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur interne du serveur"
     *     )
     * )
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
            'category_id' => $body["category_id"],
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
     * @OA\Get(
     *     path="/articles/{article}",
     *     summary="Récupérer un article par son identifiant",
     *     @OA\Parameter(
     *         name="article",
     *         in="path",
     *         description="Identifiant de l'article",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Succès - Article récupéré",        
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Article non trouvé"
     *     )
     * )
     */
    public function show(Article $article)
    {
        //on recupere les infos dans la table Vistes_articles avec l'id de l'aticle touché et l'adresse ip de l'appareil
        $vue_existante = Visites_articles::where('article_id', $article->id)
            ->whereIpAddress(request()->ip())
            ->first();
        //s'il n'y en a pas on enregistre l'id de l'article touché et l'adresse ip de l'appareil
        if (!$vue_existante) {

            Visites_articles::create([
                'ip_address' => request()->ip(),
                'article_id' => $article->id
            ]);
            // On compte le nombre d'enregistrement et on le donne au champ vues_count de l'article
          $nmbreDeVue =  Visites_articles::where('article_id', $article->id)
                ->whereNotNull('user_id')
                ->orWhereNotNull('ip_address')
                ->count();
            $article->vues_count = $nmbreDeVue;
            $article->save();
        }
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

    // ici on restore juste un article
    public function restoreArticle($id)
    {
        $article = Article::withTrashed()->find($id);
        $article->restore();
        return redirect()->back()->with('success', 'Article restored successfully');
    }
    // affichage des articles supprimées
    public function trashed()
    {
        $articles = Article::onlyTrashed()->get();

        return view('articles.deleteAll', compact('articles'));
    }


    /**
     * @OA\Put(
     *     path="/articles/{article}",
     *     summary="Mettre à jour un article",
     *     @OA\Parameter(
     *         name="article",
     *         in="path",
     *         description="Identifiant de l'article",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         description="Données de l'article",
     *        
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Article mis à jour avec succès",   
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Article non trouvé"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Erreur interne du serveur"
     *     )
     * )
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
        $article->negociation = $request->input('negociation');
        $article->category_id = $request->input('category_id');
        $article->user_id = Auth::user()->id;

        if ($article->save()) {
            return response()->json($article, 200);
        } else {
            return response()->json([
                'success' => false,
                'errors' => $article->errors(),

            ], 500);
        }
    }

    /**
     * @OA\Delete(
     *     path="/articles/{article}",
     *     summary="Supprimer un article",
     *     @OA\Parameter(
     *         name="article",
     *         in="path",
     *         description="Identifiant de l'article",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=204,
     *         description="Article supprimé avec succès"
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Article non trouvé"
     *     )
     * )
     */
    public function destroy(Article $article)
    {
        $article->delete();
        return response()->json([
            '',
            204
        ]);
    }
}