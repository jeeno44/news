<?php


namespace App\Helpers;

use App\User;
use Illuminate\Support\Facades\Auth;

class Helper
{
    public static function ActiveMenu ($url = null)
    {
        if (request()->is($url)){
            return "mdl-navigation__link active";
        }
        else{
            return "mdl-navigation__link";
        }
    }

    public static function getRole()
    {
        if (Auth::check()){
            $user = User::where("id",\Auth::user()->id)->first();
            return $user->Role->role_name;
        }
    }

}
