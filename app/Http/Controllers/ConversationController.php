<?php

namespace App\Http\Controllers;


use App\Models\Article;
use App\Models\Conversation;
use Illuminate\Http\Request;
use Illuminate\Auth\AuthManager;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Repository\ConversationRepository;
use App\Http\Resources\ConversationResource;
use App\Http\Resources\ConversationClientResource;
use App\Http\Resources\ConversationVendeurResource;

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
        $Conversation= ConversationVendeurResource::collection(Conversation::paginate(8));
    return response()->json($Conversation);

    }
    public function conversationClient()
{
    $userId = $this->auth->user()->id;
    $conversations = Conversation::where('user_id', $userId)->get();
    return ConversationClientResource::collection($conversations);
}
public function conversationVendeur()
{
    $userId = $this->auth->user()->id;
    $conversationVendeur = DB:: table('articles')
    //->SELECT * FROM `articles` WHERE id in 
    ->whereRaw('id in (SELECT article_id from conversations) AND user_id=?',[$userId] )
    ->where('user_id','=',$userId)->get();
    //return response()->json($conversationVendeur);
    //dd($conversationVendeur);
    // $conversationVendeur = DB::table('conversations')
    //     ->join('articles', 'articles.id', '=', 'conversations.article_id')
    //     ->join('users', 'users.id', '=', 'conversations.user_id')
    //     ->where('articles.user_id', '=', $userId)
    //     ->where('conversations.user_id', '!=', $userId)
    //     ->select('conversations.*', 'articles.title', 'users.name')
    //     ->get();
    return ConversationVendeurResource::collection($conversationVendeur);
}

public static function conversationArticle($id){

    $conversations=DB::table('conversations')->join('users','users.id','=','conversations.user_id')
    ->select('conversations.*','users.name')->where('article_id',$id)->get();
    // $conversations = Conversation::where('article_id',$id)->with('user')->get();
     return $conversations;
}


    public function show (Request $request, $id){

        $Conversation= new ConversationVendeurResource(Conversation::find($id));
        return response($Conversation)->json();


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
        $Conversation = new  ConversationVendeurResource($Conversation);
        return response()->json($Conversation);
    }

    // public function update(Request $request, $id){
    //     $Conversation= Conversation::find($id)->update([
    //         'article_id'=>$request->article_id,
    //         'user_id'=>$request->user_id,
    //        // "from_id"=>4
    //     ]);
    //     if($Conversation):
    //         $result = Conversation::find($id);
    //         $Conversation = new ConversationResource($result);
    //         return response()->json($Conversation);
    //     else:
    //         return response()->json(["message"=>"Echec de modification"]);
    //     endif;
    // }

    public function destroy($id)
    {
        //
    }
}


