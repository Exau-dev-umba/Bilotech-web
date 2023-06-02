<?php

namespace App\Repository;

use Carbon\Carbon;

use App\Models\Message;
use App\Models\MessageModel;
use Illuminate\Foundation\Auth\User;

class MessageRepository{

 
    private $user;
    private $message;

    public function __construct(User $user, MessageModel $message)
    {
        $this->user= $user;
        $this->message=$message;
    }

    public function getConversations(int $userId){
       return $this->user->newQuery()
        ->select('name','id')
        ->where('id','!=',$userId
        )->get();

    }

    public function createMessage(int $conversation_id, int $content,){

        return $this->message->newQuery()->create([
            'conversation_id' =>$conversation_id,
            'content'=>$content,
            'created_at'=>Carbon::now()
        ]);

    }

}