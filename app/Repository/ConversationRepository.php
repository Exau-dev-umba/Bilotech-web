<?php

namespace App\Repository;

use App\Models\Conversation;
use Carbon\Carbon;

use App\Models\Message;

use Illuminate\Foundation\Auth\User;
use Ramsey\Uuid\Type\Integer;

class ConversationRepository{

 
    private $article_id;
   private $conversation;

    public function __construct(User $article_id, Conversation $Conversation)
    {
        $this->article_id= $article_id;
      //  $this->user_id=$message;
    }

   

    public function createConversation(int $article_id, int $user_id){

        return $this->conversation->newQuery()->create([
            'article_id' =>$article_id,
            'user_id'=>$user_id,
            'created_at'=>Carbon::now()
        ]);

    }

}