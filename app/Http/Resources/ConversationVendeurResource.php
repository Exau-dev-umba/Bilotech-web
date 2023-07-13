<?php

namespace App\Http\Resources;

use App\Http\Controllers\ConversationController;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationVendeurResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request):array
    {

        $conversations = ConversationController::conversationArticle($this->id);
        
        return [
            "id" => $this->id,
            "title" => $this->title,
            "buyer" => $this->Buyer,
           // "keyword" => $this->keyword,
           // "content" => $this->content,
           // "city" => $this->city,
          //  "price" => $this->price,
           // "devise" => $this->devise,
           // "negociation" => $this->negociation,
            "clients" => $conversations

        ];
    }
}
