<?php
namespace App\Http\Controllers;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return view('users.index')->with('users', $users);
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
    }
    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user, Role $role)
    {
        if(Gate::denies('edit-users')){
            return redirect()->route('users.index');
        }

        $roles = role::all();
        return view('users.edit', compact(['user', 'roles']));
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {

        $user->roles()->sync($request->roles);
        $user->name= $request->name;
        $user->email= $request->email;
        $user->save();
        return redirect()->route('users.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        if(Gate::denies('delete-users')){
            return redirect()->route('users.index');
        }
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('users.index');
    }
}




