<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
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
            "id" => $this->id,
            "title" => $this->title,
            "keyword" => $this->keyword,
            "content" => $this->content,
            "city" => $this->city,
            "price" => $this->price,
            "devise" => $this->devise,
            "negociation" => $this->negociation,
            "images" => ImageResource::collection($this->images), 

        ];
    }
}
