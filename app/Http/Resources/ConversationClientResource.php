<?php

namespace App\Http\Resources;

use App\Http\Controllers\ConversationController;
use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {

            return [
                'id' => $this->id,
                'article_id' => $this->article_id,
                'article_title' => Article::find($this->article_id)->title,
                'user_id' => $this->user_id,
                'created_at' => \Carbon\Carbon::parse($this->created_at)->isoFormat('Y-m-d H:m:s'),
            ];
    

       
    }
}
