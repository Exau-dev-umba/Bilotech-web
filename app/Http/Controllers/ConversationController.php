<?php

namespace App\Http\Controllers;


use App\Repository\ConversationRepository;
use Illuminate\Http\Request;
use App\Http\Resources\ConversationResource;
use App\Models\Conversation;
use Illuminate\Auth\AuthManager;

class ConversationController extends Controller
{private $r;
    private $auth;

    public function __construct(ConversationRepository $conversationRepository, AuthManager $auth)
    {
        $this->r = $conversationRepository;
        $this->auth = $auth;
        
    }
    public function index (){


       /*return view('conversations/index',[
            'users'=> $this->r->getConversations($this->auth->user()->id)
        ]);*/
        $Conversation= ConversationResource::collection(Conversation::paginate(8));
    return response()->json($Conversation);

    }

    public function show (Request $request, $id){

        $Conversation= new ConversationResource(Conversation::find($id));
        return response()->json($Conversation);


    }
 
    public function store( Request $request){
        $verification = Conversation::where ("article_id", $request->article_id)->where ("user_id",$request->user_id)->get();
       // return $verification->count(); 
        if ($verification->count() > 0){
         $Conversation = $verification->first();
            return response()->json($Conversation);
        
        }
        $Conversation= Conversation::create([
            'article_id'=>$request->article_id,
            'user_id'=>$request->user_id,
           // "from_id" => 1 // TODO: remplacer par le user connecté
        ]);
        $Conversation = new  ConversationResource($Conversation);
        return response()->json($Conversation);
    }

    public function update(Request $request, $id){
        $Conversation= Conversation::find($id)->update([
            'article_id'=>$request->article_id,
            'user_id'=>$request->user_id,
           // "from_id"=>4
        ]);
        if($Conversation):
            $result = Conversation::find($id);
            $Conversation = new ConversationResource($result);
            return response()->json($Conversation);
        else:
            return response()->json(["message"=>"Echec de modification"]);
        endif;
    }

    public function destroy($id)
    {
        //
    }
}


