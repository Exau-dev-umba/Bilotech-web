<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Article;
use App\Models\Preference;
use App\Models\Visites_articles;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

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
        'temp',
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

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role');
    }

    public function hasRole($role)
    {
        return $this->roles()->whereIn('name', $role)->exists();
    }

    public function articles()
    {
        return $this->hasMany(Article::class);
    }

    public function preferences()
    {
        return $this->belongsToMany(Preference::class, 'preference_user', 'user_id', 'preference_id')->withTimestamps();
    }
    public function views()
    {
        return $this->hasMany(Visites_articles::class);
    }
}
