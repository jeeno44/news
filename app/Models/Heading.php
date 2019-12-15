<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;

class Heading extends Model
{
    protected $fillable = [
        "heading",
        "heading_name",
    ];

    public function Posts()
    {
        return $this->hasMany(Post::class,"headings_id","id");
    }
}
