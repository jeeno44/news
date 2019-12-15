<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        return view("admin.adminLayout");
    }

    public function users (User $user)
    {
//        $users = User::all();
        $users = $user->sortable()->paginate(10);

        return view("admin.users",compact("users"));
    }

    public function userEdit ($id,Request $request)
    {
        if ($request->isMethod("post")){
            $userEdit = User::find($id);

            if ($userEdit->role_id == 1 && $request->status > 1){
                return "<h1>ТАК ДЕЛАТЬ НЕЛЬЗЯ</h1>";
            }
            else{
                $userEdit->role_id = $request->status;
                $userEdit->invite = null;
                $userEdit->save();
            }
            return redirect()->route("users");
        }

        $user = User::find($id);

        return view("admin.userEdit",compact("user"));
    }
}
