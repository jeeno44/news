<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Tidings;

class Tag extends Model
{
    protected $fillable = [
        "tag",
        "tag_name"
    ];

    public function Tids()
    {
        return $this->hasMany(Tidings::class,"tag_id","id");
    }
}
