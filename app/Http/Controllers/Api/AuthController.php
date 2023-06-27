<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Role;
use App\Models\User;
use App\Models\Visites_articles;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\CreateUserAuthenticating;

class AuthController extends Controller
{

    public function login(LoginUserRequest $request, User $users)
    {
        if (auth()->attempt($request->only(['email', 'password']))) {
        } else {
            return response()->json([
                "status_code" => 403,
                "status_message" => "Desole, information invalide",
                "user" => $users
            ]);
        }
    }

    //create
    public function register(CreateUserAuthenticating $request, User $users)
    {
        try {
            if ($request->hasFile('image')) {
                $nameImage = date('YmdHis') . '.' . $request->image->extension();
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

            $user = new UserResource($users);

            $ip = $request->ip();
            Visites_articles::where('ip_address', $ip)
                ->update(['user_id' => $users->id]);

            return response()->json([
                'status' => true,
                'user' => $user,
                'token' => $user->createToken('secret')->plainTextToken
            ], 201);

        } catch (\Throwable $th) {
            //throw $th;
            return response()->json([
                'status' => false,
                'message' => $th->getMessage(),
            ], 401);
        }
    }

    //Logout user
    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => "Au revoir"
        ], 200);
    }

    //Update user
    public function updateUser(){}
    //Single user
    public function singleUser()
    {
        return response([
            'user' => auth()->user()
        ]);
    }

    public function allUser(){
        return response()->json([
            'allUser'=> User::all()
        ]);
    }

}