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

        $idVendeur = Article::find($this->article_id)->user_id;
        $nomvendeur = User::find($idVendeur)->name;
        return [
                'id' => $this->id,
                'vendeur_id' => $this->user_id,
                'vendeur_name' => $nomvendeur,
                'article_id' => $this->article_id,
                'article_title' => Article::find($this->article_id)->title,
                'buyer' => Article::find($this->article_id)->Buyer,
                'user_id' => $this->user_id,
                'created_at' => \Carbon\Carbon::parse($this->created_at)->isoFormat('Y-m-d H:m:s'),
            ];
    

       
    }
}
