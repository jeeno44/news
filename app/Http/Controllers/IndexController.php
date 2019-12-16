<?php

namespace App\Http\Controllers;

use App\Models\Heading;
use App\Models\Post;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tidings;

class IndexController extends Controller
{
    // Главная страница сайта (пустая)
    public function index()
    {
        return view("pages.index");
    }

    // Страница новостей сайта с меню рубриками
    public function news ()
    {
        $rubrics = Heading::all();

        return view("pages.news",compact("rubrics"));
    }

    // Вывод новостей для каждой рубрики
    public function rubrics (Post $post,$rub = null)
    {
        $posts = $post->where("headings_id",Heading::where("heading",$rub)->first()->id)->where("approved","yes")->sortable()->paginate(10);

        return view("pages.rubrics",compact("posts"));
    }

    // Вывод конкретной статьи из рубрики
    public function show ($id)
    {
        $post = Post::find($id);

        return view("pages.show",compact("post"));
    }
}
