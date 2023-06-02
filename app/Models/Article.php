<?php

namespace App\Models;

use App\Models\Image;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Article extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'keyword', 'content', 'country', 'city', 'price', 'negociation', 'devise', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images(){
        return $this->hasMany(Image::class);
    }
}
