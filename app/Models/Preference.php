<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{
    use HasFactory;
    protected $fillable = ['preference', 'user_id'];
    protected $casts = [
        'preference' => 'array',
    ];

    public function user()
    {
        return $this->belongsToMany(User::class, 'preference_user', 'preference_id', 'user_id')->withTimestamps();
    }


}
