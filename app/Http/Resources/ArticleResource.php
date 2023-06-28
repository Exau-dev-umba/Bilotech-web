<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class ArticleResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            
            'id' => $this->id,
            'title' => $this->title,
            'keyword' => $this->keyword,
            'content' => $this->content,
            'city' => $this->city,
            'Buyer' => $this->Buyer,
            'price' => $this->price,
            'devise' => $this->devise,
            "user_name" => User::find($this->user_id)->name,
            "country" => $this->country,
            "category_id" => $this->category_id,
            "category_name" => Category::find($this->category_id)->category_name,
            "user_id" => $this->user_id,
            "vues_count" => $this->vues_count,
            "like_count" => $this->like_count,
            'negociation' => $this->negociation,
            "created_at" => $this->created_at,
            'images' => ImageResource::collection($this->images),

        ];
        
    }
}
