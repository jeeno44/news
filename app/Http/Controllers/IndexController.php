<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Tidings;

class IndexController extends Controller
{
    public function index()
    {

        return view("pages.index");
    }

    public function news ()
    {

        return view("pages.news");
    }
}
