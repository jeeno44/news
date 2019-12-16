<?php


namespace App\Helpers;

use App\Models\Post;
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

    public static function getDate($datetime)
    {
        return substr($datetime,0,10);
    }

    public static function getTime($datetime)
    {
        return substr($datetime,-8);
    }

    public static function isAdmin ()
    {
        if (Auth::check()){
            if (Auth::user()->role_id == 1){
                return true;
            }
            else{
                return false;
            }
        }
    }

    public static function isEditor ()
    {
        if (Auth::check()){
            if (Auth::user()->role_id == 2){
                return true;
            }
            else{
                return false;
            }
        }
    }

    public static function isAuthor ($post)
    {
        if (Auth::check()){

                if (Auth::user()->id == Post::find($post)->user_id){
                    return true;
                }
                else{
                    return false;
                }

        }
    }

    public static function isUser ()
    {
        if (Auth::check()){
            if (Auth::user()->role_id == 3){
                return true;
            }
            else{
                return false;
            }
        }
    }

    public static function isGuest ()
    {
        if (Auth::check()){
            return true;
        }
        else{
            return false;
        }
    }

    public static function getLastIdPost ()
    {
        return (Post::orderBy("id","desc")->first()->id)+1;
    }

    public static function rusEvent ($event)
    {
        switch ($event){
            case "created":     return "Запись создана"; break;
            case "moderated":   return "Модерация"; break;
            case "updated":     return "Запись отредактирована"; break;
            case "deleted":     return "Запись удалена"; break;
        }
    }



}
