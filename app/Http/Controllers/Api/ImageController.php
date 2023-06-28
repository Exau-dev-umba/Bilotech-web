<?php

namespace App\Http\Controllers\Api;
use App\Models\Image;
use App\Models\Article;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Spatie\FlareClient\Http\Response;
use Illuminate\Support\Facades\Request;
use App\Http\Requests\StoreImageRequest;
use App\Http\Requests\UpdateImageRequest;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
    public function store(StoreImageRequest $request, Article $id)
    {

        if ($request->hasFile('image_path')) {

                foreach ($request->file('image_path') as $image) {
                    $result = hash('md5', microtime(true));
                    $nameImage = $result .'.' . $image->extension();
                    $fichier = $image->storeAs('articles/'.Auth::user()->id, $nameImage, 'public');
                    $newImage = new Image();
                    $newImage->image_path = $fichier;
                    // Utiliser la méthode store du contrôleur ImageController
                    $id->images()->save($newImage);
                }

            return response('', 201);
        }
        
    }

    

    /**
     * Display the specified resource.
     */
    public function show(Image $image)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Image $image)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateImageRequest $request, Image $image)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Image $image)
    {
        
    }
}
