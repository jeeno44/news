<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    protected $fillable = [
        "datetime",
        "author_id",
        "post_create_id",
        "post_edit_id",
        "post_deleted_id",
        "post_moderated_id",
    ];
}
