<?php

namespace App\Http\Controllers;

use App\Http\Resources\ConversationResource;
use App\Models\User;
use App\Models\Message;
use App\Models\MessageModel;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\Auth;
use App\Repository\MessageRepository;
use App\Http\Resources\MessageResource;
use App\Models\ConversationModel;

class 
MessageController extends Controller
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
        $Messages= MessageResource::collection(MessageModel::paginate(10));
    return response()->json($Messages);

    }

    public function show (Request $request, $id){

        $message= new MessageResource(MessageModel::find($id));
        return response()->json($message);


    }
    public function listemessage($id){
        //$conversation  = MessageResource::collection(MessageModel::find($id));
        $conversation= MessageModel::findOrFail($id);
        //$conversation = new MessageResource()
        return response()->json($conversation);
    }
    public function store( Request $request){
        $message= MessageModel::create([
            'conversation_id'=>$request->conversation_id,
            'content'=>$request->content,
           // "from_id" => 1 // TODO: remplacer par le user connecté
        ]);
        $Message = new  MessageResource($message);
        return response()->json($Message);
    }

    public function update(Request $request, $id){
        $Message= MessageModel::find($id)->update([
            'conversation_id'=>$request->name,
            'content'=>$request->article_id,
           // "from_id"=>4
        ]);
        if($Message):
            $result = MessageModel::find($id);
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
