<?php

namespace App\Http\Controllers;

use App\Events\LoggingPostEnevt;
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
use Illuminate\Support\Facades\Storage;
use Kyslik\ColumnSortable\Sortable;

class PostController extends Controller
{

//     Проверяем урвоень доступа к контроллеру и методам контроллера
    public function __construct()
    {
        $this->middleware("auth");
        $this->middleware(["auth","user"]);
    }

//    Выводим список всех постов
//    Если это админ то выводятся все посты всех редакторов (сортировка есть)
    public function index(Post $post)
    {
        if (Auth::user()->role_id == 1){
            $posts = $post->sortable()->paginate(10);
        }
        else{
            $userId = Auth::user()->id;
            $posts = $post->where("user_id",$userId)->sortable()->paginate(10);
        }

        return view("post.index",compact("posts"));
    }

    // Страница добавления новой статьи
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

    // Метод добавления статьи в базу данных
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

        // Валидация данных
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

        event(new LoggingPostEnevt(Post::orderBy("id","desc")->first(),Auth::user()->id,"created")); // Логгирование

        return redirect()->route("post.index");

    }

    // Страница отображения конкретной статьи
    public function show($id)
    {
        // Проверка прав доступа (Автор или админ)
        if (!Hp::isAdmin() && !Hp::isAuthor($id)){
            return redirect()->route("post.index");
        }
        else{
            try{
                $post = Post::findOrFail($id);
            }
            catch (\Exception $exception){
                return abort(404);
            }
        }

        return view("post.show",compact("post"));
    }

    // Страница редактирования статьи
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

    // Метод записи в базу данных отредактированной статьи
    public function update(Request $request, $id)
    {
        // Валидация данных
        $this->validate($request,[
            "headline"  => "required",
            "post"      => "required",
            "approved"  => "required",
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

        if ($request->image != null){
//            $newUpdateImage = "/source/uploadImg/posts/$id.jpg";
            Storage::disk("local")->delete("/source/uploadImg/posts/$id.jpg");
            $newUpdateImage = $request->file('image')->storeAs("/source/uploadImg/posts",$id.".jpg");
        }

//        $post->image        = $newUpdateImage;
        $post->headings_id  = $request->headings_id;
        $post->import_id    = $request->import_id;
        $post->approved     = $request->approved;
        $post->save();

        event(new LoggingPostEnevt(Post::find($id),Auth::user()->id,"updated"));  // Логгирование

        return redirect()->route("post.index");

    }

    // Метод удаления статья
    public function destroy($id)
    {
        // Проверка прав доступа
        if (!Hp::isAuthor($id) && !Hp::isAdmin()){
            return redirect()->route("index");
        }
        else{
            Tidings::where('post_id', $id)->delete();
            $post = Post::find($id);
            event(new LoggingPostEnevt(Post::find($id),Auth::user()->id,"deleted"));  // Логгирование
            $post->delete();



            return redirect()->route("post.index");
        }

    }

    // Удаление статьи по идентификатору
    public function psevdoRemove ($id)
    {
        if (!Hp::isAuthor($id) && !Hp::isAdmin()){
            return redirect()->route("index");
        }
        else{
            Tidings::where('post_id', $id)->delete();
            $post = Post::find($id);
            event(new LoggingPostEnevt(Post::find($id),Auth::user()->id,"deleted"));  // Логгирование
            $post->delete();
            return redirect()->route("post.index");
        }

    }

    // Изменение видимости статьи (Модерация)
    public function updateApproved ($id,Request $request)
    {
        if (!Hp::isAuthor($id) && !Hp::isAdmin()){
            return "Allowed or Denied";
        }
        else{

            $post = Post::find($id);
            $post->approved = $request->status;
            $post->save();

            event(new LoggingPostEnevt(Post::find($id),Auth::user()->id,"moderated"));  // Логгирование

            return "OK";
        }
    }
}
