<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    protected $table = 'conversations';
    protected $fillable = [
        'article_id',
        'user_id',
        
    ];
    public $timestamps= true;
    protected $dates = ['created_at','read_at']; 
    
    use HasFactory;
}
