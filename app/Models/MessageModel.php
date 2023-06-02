<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    protected $table = 'messages';
    protected $fillable = [
        'conversation_id',
        'content',
        
    ];

    public $timestamps= true;

    protected $dates = ['created_at','read_at'];
}
