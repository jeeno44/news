<?php

namespace App\Http\Controllers;

use App\Models\Heading;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware(["auth","user"]);
    }

    public function index()
    {
        $userId = Auth::user()->id;

        $posts = Post::where("user_id",$userId)->get();

        return view("post.index",compact("posts"));
    }

    public function create()
    {
        $higs = Heading::all();

        return view("post.create",compact("higs"));
    }

    public function store(Request $request)
    {
        dd($request);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
