<?php

namespace App\Http\Controllers\Api;

use App\Models\Tag;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TagController extends Controller
{
    public function index()
    {
        $tags = Tag::all();
        return $tags;
    }
    public function store(Request $request){
        $tag=Tag::create([
            'nom'=>$request->nom
        ]);

        return response()->json($tag->id);
    }
}
