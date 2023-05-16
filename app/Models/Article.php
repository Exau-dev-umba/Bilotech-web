<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'keyword', 'content', 'country', 'city', 'price', 'similar_ad', 'devise', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
