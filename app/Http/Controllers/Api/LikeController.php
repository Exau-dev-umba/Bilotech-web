<?php

namespace App\Http\Controllers\Api;

use App\Models\Like;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LikeController extends Controller
{
    public function likeOrUnlike($id)
    {
        $article = Article::find($id);

        if (!$article) {
            return response([
                'message' => 'Article not found.'
            ], 403);
        }

        $like = $article->likes()->where('user_id', auth()->user()->id)->first();

        // s'il n'y a pas de like, ç'ajoute un like
        if (!$like) {
            Like::create([
                'article_id' => $id,
                'user_id' => auth()->user()->id
            ]);

            return response([
                'message' => 'Liked'
            ], 200);
        }
        // sinon enlever le like
        $like->delete();

        return response([
            'message' => 'Disliked'
        ], 200);
    }
}
