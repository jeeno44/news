<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    public function User ()
    {
        return $this->belongsTo(User::class,'user_id',"id");
    }

    public function Higs ()
    {
        return $this->belongsTo(Heading::class,"headings_id","id");
    }

    public function Imps ()
    {
        return $this->belongsTo(Importance::class,"import_id","id");
    }

    public function Tids ()
    {
        return $this->hasMany(Tidings::class,"post_id","id");
    }
}
