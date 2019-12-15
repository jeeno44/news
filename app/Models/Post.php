<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Kyslik\ColumnSortable\Sortable;


class Post extends Model
{
    use Notifiable,Sortable;

    protected $fillable = [
        "user_id",
        "headline",
        "subheadline",
        "post",
        "image",
        "headings_id",
        "import_id",
        "approved"
    ];

    public $sortable = [
        "id",
        "user_id",
        "headline",
        "subheadline",
        "post",
        "headings_id",
        "import_id",
        "approved",
    ];

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
