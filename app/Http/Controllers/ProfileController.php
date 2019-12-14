<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view("profile.index",compact("user"));
    }

    public function edit (Request $request)
    {
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

    public function invite ($resp)
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
}
