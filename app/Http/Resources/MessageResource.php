<?php

namespace App\Http\Resources;

use App\Models\User;
use App\Models\Message;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MessageResource extends JsonResource
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
                'conversation_id' => $this->conversation_id,
                'content' => $this->content,
                'user_id' => $this->user_id,
                'created_at' => $this->created_at->format('Y-m-d H:i:s'),
                'updated_at' => $this->updated_at->format('Y-m-d H:i:s'),
                //'user' => new UserResource($this->Auth::user()->id),
            ];
        
           // $article_title=Article::find($this->article_id)->title;
           // $collection = Conversation::all();
            //$conversationA = $collection->groupBy('article_id');
            $conversation_message = Message::where('conversation_id', $this->conversation_id)->get();
            $messages = [];
                foreach ($conversation_message as $message) {
                    $messages[] = [
                        'id' => $message->conversation_id,
                        'content' => $message->content,
                        
                        //'nom' => User::find($message->user_id)->name,
                    ];
                }
                $sortie = [
                    'id' => $this->id,
                    'content' => Message::where($this->conversation_id),
                    'date' => \Carbon\Carbon::parse($message->created_at)->isoFormat('DD | MM | Y h:mm '),
                    'messages' => $messages,
                ];
            return $sortie;
        
        //return [
          //  'id'=>$this->id,
         //   'conversation_id'=>$this->conversation_id,
          //  'content'=>$this->content,
         //   'user_id'=>$this->user_id,
        //    'date'=>$this->created_at
      //  ];
      
    }
}
