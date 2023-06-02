<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';
    protected $fillable = [
        'conversation_id',
        'content',
        'user_id'
        
    ];

    public $timestamps= true;

    protected $dates = ['created_at','read_at'];
}
