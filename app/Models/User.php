<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Models\Role;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\File;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'image',
        'telephone',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function roles(){
        return $this->belongsToMany('App\Models\Role');
    }

    public function hasRole($role)
    {
    return $this->roles()->where('name', $role)->exists();
    }
    public function articles()
    {
        return $this->hasMany(Article::class);

    }

    protected static function boot()
    {
        parent::boot();
    
        static::created(function ($user) {
            $adminRole = Role::where('name', 'admin')->first();
            if (!$adminRole) {
                $adminRole = Role::create(['name' => 'admin']);
            }
            if (User::count() == 1) {
                $user->roles()->attach($adminRole);
            } else {
                $user->roles()->attach(Role::where('name', 'user')->first());
            }
        });
    }
}
