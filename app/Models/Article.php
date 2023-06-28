<?php

namespace App\Models;


use App\Models\Image;
use App\Models\Visites_articles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'keyword', 'content', 'country', 'city', 'Buyergit ', 'price', 'negociation',  'category_id', 'devise', 'user_id'];
    protected $dates = ['deleted_at'];


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function images()
    {
        return $this->hasMany(Image::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function views()
    {
        return $this->hasMany(Visites_articles::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }


    public function conversations(){
        return $this->hasMany(Conversation::class);

    }
    

}
