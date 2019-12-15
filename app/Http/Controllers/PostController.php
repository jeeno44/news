<?php

namespace App\Http\Controllers;

use App\Helpers\Helper as Hp;
use App\Models\Heading;
use App\Models\Importance;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Tidings;
use Illuminate\Http\Request;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Kyslik\ColumnSortable\Sortable;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware(["auth","user"]);
    }

    public function index(Post $post)
    {
        if (Auth::user()->role_id == 1){
//            $posts = Post::all();
            $posts = $post->sortable()->paginate(10);
        }
        else{
            $userId = Auth::user()->id;
//            $posts = Post::where("user_id",$userId)->get();
            $posts = $post->where("user_id",$userId)->sortable()->paginate(10);
        }

        return view("post.index",compact("posts"));
    }

    public function create()
    {
        if (Hp::isEditor() || Hp::isAdmin()){
            $higs = Heading::all();
            $imps = Importance::all();
            $tags = Tag::all();
        }
        else{
            return redirect()->route("post.index");
        }

        return view("post.create",compact("higs","imps","tags"));
    }

    public function store(Request $request)
    {
        if ($request->image != null){
            $request->file('image')->storeAs("/source/uploadImg/posts/",Hp::getLastIdPost().".jpg");
        }

        $newId = Hp::getLastIdPost();

        $newPost = [
            "user_id"       => $request->user_id,
            "headings_id"   => $request->headings_id,
            "headline"      => $request->headline,
            "subheadline"   => $request->subheadline,
            "image"         => "/source/uploadImg/posts/".$newId.".jpg",
            "post"          => $request->post,
            "import_id"     => $request->import_id,
            "approved"      => $request->approved,
        ];

        $this->validate($request,[
            "headline"  => "required",
            "post"      => "required",
            "approved"  => "required",
            "image"     => "required|mimes:jpg,jpeg,png",
        ]);

        $tags = [];

        foreach($request->tag_id as $tag) {
            $tags[] = [
                "post_id"   => $newId,
                "tag_id"    => $tag
            ];
        }

        Post::create($newPost);

        foreach ($tags as $tag) {
            Tidings::create($tag);
        }

        return redirect()->route("post.index");

    }

    public function show($id)
    {
        if (!Hp::isAdmin() && !Hp::isAuthor($id)){
            return redirect()->route("post.index");
        }
        else{
            if ($id > Post::get()->count()){
                return abort(404);
            }
            else{
                $post = Post::find($id);
            }
        }

        return view("post.show",compact("post"));
    }

    public function edit($id)
    {
        if (Hp::isAuthor($id) || Hp::isAdmin()){
            $post = Post::find($id);
            $higs = Heading::all();
            $imps = Importance::all();
            $tags = Tag::all();
        }
        else{
            return redirect()->route("post.index");
        }

        return view("post.edit",compact("post","higs","imps","tags"));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request,[
            "headline"  => "required",
            "post"      => "required",
            "approved"  => "required",
            "image"     => "required|mimes:jpg,jpeg,png",
        ]);

        Tidings::where("post_id",$id)->delete();
        $newIdPost = (Tidings::orderBy("id","desc")->first()->id)+1;
        $statement = "ALTER TABLE tidings AUTO_INCREMENT = $newIdPost;";
        DB::unprepared($statement);

        $tags = [];

        foreach($request->tag_id as $tag) {
            $tags[] = [
                "post_id"   => $id,
                "tag_id"    => $tag
            ];
        }

        foreach ($tags as $tag) {
            Tidings::create($tag);
        }

        if ($request->image != null){
            $request->file('image')->storeAs("/source/uploadImg/posts/",$id.".jpg");
        }

        $post = Post::find($id);
        $post->headline     = $request->headline;
        $post->subheadline  = $request->subheadline;
        $post->post         = $request->post;
        $post->image        = "/source/uploadImg/posts/$id.jpg";
        $post->headings_id  = $request->headings_id;
        $post->import_id    = $request->import_id;
        $post->approved     = $request->approved;
        $post->save();

        return redirect()->route("post.index");

    }

    public function destroy($id)
    {

        if (!Hp::isAuthor($id) && !Hp::isAdmin()){
            return redirect()->route("index");
        }
        else{
            Tidings::where('post_id', $id)->delete();
            $post = Post::find($id);
            $post->delete();

            return redirect()->route("post.index");
        }

    }

    public function psevdoRemove ($id)
    {
        if (!Hp::isAuthor($id) && !Hp::isAdmin()){
            return redirect()->route("index");
        }
        else{
            Tidings::where('post_id', $id)->delete();
            $post = Post::find($id);
            $post->delete();
            return redirect()->route("post.index");
        }

        //return view("psevdoRemove");
    }

    public function updateApproved ($id,Request $request)
    {
        if (!Hp::isAuthor($id) && !Hp::isAdmin()){
            return "Allowed or Denied";
        }
        else{

            $post = Post::find($id);
            $post->approved = $request->status;
            $post->save();

            return "OK";
        }
        //return view("updateApproved");
    }
}
