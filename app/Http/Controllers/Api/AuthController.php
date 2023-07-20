<?php

namespace App\Http\Controllers\Api;


use Exception;
use App\Models\Role;
use App\Models\User;
use App\Mail\WelcomeMail;
use Illuminate\Http\Request;
use App\Models\Visites_articles;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\CreateUserAuthenticating;

class AuthController extends Controller
{
    public function login(LoginUserRequest $request, User $users)
    {
        if (auth()->attempt($request->only(['email', 'password']))) {
        } else {
            return response()->json([
                'status_code' => 403,
                'status_message' => 'Desole, information invalide',
                'user' => $users,
            ]);
        }
    }

    // create
    public function register(CreateUserAuthenticating $request, User $users)
    {
        try {
            if ($request->hasFile('image')) {
                $nameImage = date('YmdHis').'.'.$request->image->extension();
                $image = $request->image->storeAs('profiles', $nameImage, 'public');
            } else {
                $image = null;
            }

            $validate = $request->validate([
                'name' => "required",
                'password' => "required",
                'email' => "required",
                'telephone' => "required"
            ]);

            $users = User::create([
                "name" => $request->name,
                "email" => $request->email,
                "image" => Storage::url($image),
                "telephone" => $request->telephone,
                "password" => Hash::make($request->password, ["rounds" => 12])
            ]);
            
            // Récupérer le rôle "user" à partir de la table roles
            $role = Role::where('name', 'user')->first();
            
            // Attacher le rôle à l'utilisateur
            $users->roles()->attach($role);

            $user = new UserResource($users);

            
            $ip = $request->ip();
            Visites_articles::where('ip_address', $ip)
            ->update(['user_id' => $users->id]);
            
            // Envoie d'un mail de bienvenue à l'utilisateur
             //Mail::to($user->email)->send(new WelcomeMail($user));
             
            return response()->json([
                'status' => true,
                'user' => $user,
                'token' => $user->createToken('secret')->plainTextToken
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 401);

        }
    }

    // Logout user
    public function logout()
    {
        auth()->user()->tokens()->delete();

        return response([
            'message' => 'Au revoir',
        ], 200);
    }


    //Update user
    public function updateUser(Request $request, $id){
        try {

            $validator = Validator::make($request->all(), [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|',
                'password' => 'string',
                'telephone' => 'string|min:6',
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors()->toJson(), 400);
            }

            $user = User::find($id);
            if (!$user) {
                return response()->json(['message' => 'Utilisateur non trouvé'], 404);
            }

            $user->name = $request->name;
            $user->email = $request->email;
            $user->telephone = $request->telephone;
            $user->temp = 0;
            $user->password = Hash::make($request->password, ["rounds" => 12]);
            //dd($user);
            $user->save();
            
            // Récupérer le rôle "user" à partir de la table roles
            $role = Role::where('name', 'user')->first();

            // Attacher le rôle à l'utilisateur
            $user->roles()->attach($role);

            $user = new UserResource($user);

            return response()->json([
                'status' => true,
                'user' => $user,
                'token' => $user->createToken('secret')->plainTextToken
            ], 201);

        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 401);
        }
        
    }

    public function updateImageProfile( Request $request, $id)
    {
        try {
            dd($request->hasFile('image'));
            if ($request->hasFile('image')) {
                $nameImage = date('YmdHis') . '.' . $request->image->extension();
                $image = $request->image->storeAs('profiles/'.Auth::user()->id, $nameImage, 'public');
            } else {
                $image = null;
            }
            $user = User::find($id);
            $user->image = $image;
            $user->save();

            return response()->json([
                'user' => $user->image
            ]);
            
        } catch (\Throwable $th) {
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 401);
        }
    }

    // Single user
    public function singleUser()
    {
        return response([
            'user' => auth()->user(),
        ]);
    }

    public function allUser()
    {
        return response()->json([
            'allUser' => User::all(),
        ]);
    }
}
