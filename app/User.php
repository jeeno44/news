<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Role;
use App\Models\Post;
use Kyslik\ColumnSortable\Sortable;

class User extends Authenticatable
{
    use Notifiable,Sortable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
       'role_id', 'name', 'email', 'password', 'invite'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function Role()
    {
       return $this->belongsTo(Role::class,'role_id','id');
    }

    public function Posts()
    {
       return $this->hasMany(Post::class,'user_id','id');

    }

    public $sortable = [
        'id',
        'role_id',
        'name',
        'email',
        'created_at',
        'updated_at'];

}
