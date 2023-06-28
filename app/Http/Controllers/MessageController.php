<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Message;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;
use App\Repository\MessageRepository;
use App\Http\Resources\MessageResource;
use App\Http\Resources\ConversationResource;

class MessageController extends Controller
{
    private $r;
    private $auth;

    public function __construct(MessageRepository $conversationRepository, AuthManager $auth)
    {
        $this->r = $conversationRepository;
        $this->auth = $auth;
        
    }
    public function index (){


       /*return view('conversations/index',[
            'users'=> $this->r->getConversations($this->auth->user()->id)
        ]);*/
        $Messages= MessageResource::collection(Message::paginate(10));
    return response()->json($Messages);

    }

    public function show (Request $request, $id){

        $message= new MessageResource(Message::find($id));
        return response()->json($message);


    }
    public function listemessage($id){
        //$conversation  = MessageResource::collection(MessageModel::find($id));
        $conversation= Message::findOrFail($id);
        //$conversation = new MessageResource()
        return response()->json($conversation);
    }
    public function store( Request $request,){
        //$conversation= Conversation::find($conversation_id);
        $data=[
            'conversation_id'=>$request->conversation_id,
            'content'=>$request->content,
            'user_id'=> Auth::user()->id
           // "from_id" => 1 // TODO: remplacer par le user connecté
        ];
        //dd($data);
        $message= Message::create($data);
        $Message = new  MessageResource($message);
        return response()->json($Message);
    }

    public function messageParConversation($conversationId)
{
    $messages = Message::where('conversation_id', $conversationId)->get();
    return MessageResource::collection($messages);
}

    public function update(Request $request, $id){
        $Message= Message::find($id)->update([
            'conversation_id'=>$request->name,
            'content'=>$request->article_id,
           // "from_id"=>4
        ]);
        if($Message):
            $result = Message::find($id);
            $Message = new MessageResource($result);
            return response()->json($Message);
        else:
            return response()->json(["message"=>"Echec de modification"]);
        endif;
    }

    public function destroy($id)
    {
        //
    }
}
