<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\User;
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
            $users->name = $request->name;
            $users->email = $request->email;
            $users->image = Storage::url($image);
            $users->telephone = $request->telephone;
            $users->password = Hash::make($request->password, [
                "rounds" => 12
            ]);
            $users->save();
            $users = new UserResource($users);
            return response()->json([
                "status_code" => "200",
                "status_message" => "Operation de creation d'Utilisateur reussi",
                "user" => $users
            ]);
        } catch (Exception $e) {
            return response()->json($e);
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