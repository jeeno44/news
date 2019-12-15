<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Role extends Model
{
    protected $fillable = [
        "role",
        "role_id"
    ];

    public function Users()
    {
       return $this->hasMany(User::class,'role_id','id');
    }
}
