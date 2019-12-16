<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Models\Post;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;

class Log extends Model
{
    use Notifiable,Sortable;

    protected $fillable = [
        "datetime",
        "event",
        "author_id",
        "post_id",
    ];

    public $sortable = [
        'id',
        'datetime',
        'event',
        'author_id',
        'post_id',
    ];

    public function User()
    {
        return $this->belongsTo(User::class,"author_id","id");
    }

    public function Post()
    {
        return $this->belongsTo(Post::class,"post_id","id");
    }

}
