<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    // Страница для просмотра профиля пользователя
    public function index()
    {
        $user = Auth::user();

        return view("profile.index",compact("user"));
    }

    // Страница с формой для редактирования пользователя
    public function edit (Request $request)
    {
        // Метод сохранения изменений в базу данных
        if ($request->isMethod("post")){

            $this->validate($request,[
                "name"  => "required",
                "email" => "required|email",
                "password" => 'required|min:5',
                "repassword" => 'required|min:5'
            ]);

            if ($request->password == $request->repassword){

                $user = Auth::user();
                $user->name = $request->name;
                $user->email = $request->email;
                $user->password = Hash::make($request->password);
                $user->save();
            }

            return redirect()->route("profile");
        }

        $user = Auth::user();

        return view("profile.edit",compact("user"));
    }

    // Метод подтвердения приглашения в редакторы
    public function inviteConfirm ($resp)
    {
        $me = Auth::user();

        if ($resp == "yes"){
            $me->role_id = 2;
            $me->invite = null;
            $me->save();
        }
        elseif ($resp == "no"){
            $me->invite = "no";
            $me->save();
        }
        else{
            return abort(404);
        }
        return redirect()->route("profile");
    }

    //  Метод приглашения в редакторы
    public function sendinvite (Request $request)
    {
        $user = \App\User::find($request->id);
        $user->invite = "Хочешь в редакторы ?";
        $user->save();

        return "200";
    }

    // Метод выхода из профиля
    public function logout ()
    {
        if (Auth::check()){
            Auth::logout();
            return redirect()->route("index");
        }
    }

    // Метод удаления пользователя. (под вопросом)
    public function delete ()
    {

        //return view("delete");
    }
}
