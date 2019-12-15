<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use App\Models\Tag;

class Tidings extends Model
{
    protected $fillable = [
        "post_id",
        "tag_id"
    ];

    public function Posts()
    {
        return $this->belongsTo(Post::class,"post_id","id");
    }

    public function Tags()
    {
        return $this->belongsTo(Tag::class,"tag_id","id");
    }
}
