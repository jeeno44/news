<?php

namespace App\Http\Controllers;

use App\Models\Heading;
use App\Models\Log;
use App\Models\Tag;
use App\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    // Главная старница админа (пустая)
    public function index()
    {
        return view("admin.adminLayout");
    }

    // Вывод всех пользователей с сортировкой и пагинацией (постраничный вывод по 10 записей)
    public function users (User $user)
    {
        $users = $user->sortable()->paginate(10);

        return view("admin.users",compact("users"));
    }

    // Страница редактирования статуса пользователя (админ, редактор, пользователь)
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

    // Добавляем рубрики для статей
    public function rubrics (Request $request)
    {
        if ($request->isMethod("post")){
            // Валидация
            $this->validate($request,[
                "heading"       => "required|min:3",
                "heading_name"  => "required|min:3",
            ]);

            Heading::create($request->all());
            return redirect()->route("profile");
        }

        return view("admin.rubrics");
    }

    // Добавляем теги для статей
    public function tags (Request $request)
    {
        if ($request->isMethod("post")){

            // Валидация
            $this->validate($request,[
                "tag"       => "required|min:3",
                "tag_name"  => "required|min:3",
            ]);

            Tag::create($request->all());
            return redirect()->route("profile");
        }

        return view("admin.tags");
    }

    // Просмотр об активности статей (Добавление, редактирование, удаление и модерация)
    public function logs (Log $log)
    {
        $logs = $log->sortable()->paginate(10);

        return view("admin.logs",compact("logs"));
    }
}
