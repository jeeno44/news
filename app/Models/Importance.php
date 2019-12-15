<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Importance extends Model
{
    protected $fillable = [
        "import",
        "import_name",
    ];

    public function Posts()
    {
        return $this->hasMany(Post::class,"import_id","id");
    }
}
