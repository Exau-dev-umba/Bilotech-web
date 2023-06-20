<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\Article;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ConversationResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request):array
    {
        $article_title=Article::find($this->article_id)->title;
        $collection = Conversation::all();
        //$conversationA = $collection->groupBy('article_id');
        $conversationsA = Conversation::where('article_id', $this->article_id)->get();
        $clients = [];
            foreach ($conversationsA as $conversation) {
                $clients[] = [
                    'id' => $conversation->user_id,
                    'nom' => User::find($conversation->user_id)->name,
                ];
            }
            $sortie = [
                'id' => $this->id,
                'article_id' => $this->article_id,
                'article_title' => Article::find($this->article_id)->title,
                'date' => \Carbon\Carbon::parse($conversation->created_at)->isoFormat('DD | MM | Y h:mm '),
                'clients' => $clients,
            ];
        return $sortie;
    }
}
