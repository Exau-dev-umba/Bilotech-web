<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\CreateUserAuthenticating;

class AuthController extends Controller
{
    
    public function login(LoginUserRequest $request, User $users) {
        if(auth()->attempt($request->only(['email', 'password']))) {
        }
        else{
            return response()->json([
                "status_code" => 403,
                "status_message" => "Desole, information invalide",
                "user" => $users
            ]);
        }
    }
    



}

