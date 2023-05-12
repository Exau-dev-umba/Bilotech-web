<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MessageModel extends Model
{
    protected $table = 'message';
    protected $fillable = [
        'content',
        'from_id',
        'article_id',
        'read_at',
        'created_at',
    ];

    public $timestamps= false;

    protected $dates = ['created_at','read_at'];
}
