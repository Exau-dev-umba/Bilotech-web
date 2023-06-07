<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\View\View;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
 
class UserController extends Controller
{
    /**
     * Show the profile for the given user.
     */
    public function show(string $id): View
    {
        $user =Auth::user()->name ?? null ;
        Log::info('User {id} .', ['id' => $user->id]);
        return view('user.profile', [
            'user' => Auth::user()($id)
        ]);
    }
}