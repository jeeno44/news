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
    public function __construct()
    {

    }

    public function index()
    {
        return view("pages.index");
    }

    public function news ()
    {
        $rubrics = Heading::all();

        return view("pages.news",compact("rubrics"));
    }

    public function rubrics ($rub = null)
    {
        $posts = Post::where("headings_id",Heading::where("heading",$rub)->first()->id)->get();

        return view("pages.rubrics",compact("posts"));
    }
}
