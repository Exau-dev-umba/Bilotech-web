<?php

namespace App\Models;

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Visites_articles extends Model
{
    use HasFactory;
    protected $fillable = [
        'ip_address',
        'user_id',
        'article_id',
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function articles()
    {
        return $this->belongsToMany(Article::class);
    }
}
