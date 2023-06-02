<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Role extends Model
{

    use HasFactory;
    public $incrementing = false;
    protected $fillable = [ 
         'name' 
    ];

    public function users(){
        return $this->belongsToMany('App\Models\User');
    }

    public function hasRole($roleName)
{
    return $this->roles()->where('name', $roleName)->exists();
}

}