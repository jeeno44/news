<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AppendPosts extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $firstEditor = DB::table("users")->where("role_id",2)->first()->id;
        $lastEditor = DB::table("users")->where("role_id",2)->orderBy("id","desc")->first()->id;

        $posts = [
            [
                "user_id" => $firstEditor,
                "headline" => "Заголовок (Политика)",
                "subheadline" => "Подзаголовок (Политика)",
                "post" => "Страница похожа на единую ленту гастролей, событий и новостей «ДДТ». 
                Раньше это был черный фон и белые буквы – с главной я всегда уходил в легендарный «ЧаДДТ». 
                Новый дизайн на порядок современнее и уж точно лучше, чем у большинства коллег по цеху.",
                "image" => "/source/uploadImg/posts/1.jpg",
                "headings_id" => 1,
                "import_id" => 1,
                "approved" => "yes",
            ],
            [
                "user_id" => $firstEditor,
                "headline" => "Заголовок2 (Политика)",
                "subheadline" => "Подзаголовок2 (Политика)",
                "post" => "Страница похожа на единую ленту гастролей, событий и новостей «ДДТ». 
                Раньше это был черный фон и белые буквы – с главной я всегда уходил в легендарный «ЧаДДТ». 
                Новый дизайн на порядок современнее и уж точно лучше, чем у большинства коллег по цеху.",
                "image" => "/source/uploadImg/posts/2.jpg",
                "headings_id" => 1,
                "import_id" => 1,
                "approved" => "yes",
            ],
            [
                "user_id" => $firstEditor,
                "headline" => "Заголовок3 (Политика)",
                "subheadline" => "Подзаголовок3 (Политика)",
                "post" => "Страница похожа на единую ленту гастролей, событий и новостей «ДДТ». 
                Раньше это был черный фон и белые буквы – с главной я всегда уходил в легендарный «ЧаДДТ». 
                Новый дизайн на порядок современнее и уж точно лучше, чем у большинства коллег по цеху.",
                "image" => "/source/uploadImg/posts/3.jpg",
                "headings_id" => 1,
                "import_id" => 1,
                "approved" => "yes",
            ],
            [
                "user_id" => $firstEditor,
                "headline" => "Заголовок (Юмор)",
                "subheadline" => "Подзаголовок (Юмор)",
                "post" => "Страница похожа на единую ленту гастролей, событий и новостей «ДДТ». 
                Раньше это был черный фон и белые буквы – с главной я всегда уходил в легендарный «ЧаДДТ». 
                Новый дизайн на порядок современнее и уж точно лучше, чем у большинства коллег по цеху.",
                "image" => "/source/uploadImg/posts/4.jpg",
                "headings_id" => 2,
                "import_id" => 1,
                "approved" => "yes",
            ],
            [
                "user_id" => $lastEditor,
                "headline" => "Заголовок2 (Юмор)",
                "subheadline" => "Подзаголовок2 (Юмор)",
                "post" => "Страница похожа на единую ленту гастролей, событий и новостей «ДДТ». 
                Раньше это был черный фон и белые буквы – с главной я всегда уходил в легендарный «ЧаДДТ». 
                Новый дизайн на порядок современнее и уж точно лучше, чем у большинства коллег по цеху.",
                "image" => "/source/uploadImg/posts/5.jpg",
                "headings_id" => 2,
                "import_id" => 1,
                "approved" => "yes",
            ],
            [
                "user_id" => $lastEditor,
                "headline" => "Заголовок (Религия)",
                "subheadline" => "Подзаголовок (Религия)",
                "post" => "Страница похожа на единую ленту гастролей, событий и новостей «ДДТ». 
                Раньше это был черный фон и белые буквы – с главной я всегда уходил в легендарный «ЧаДДТ». 
                Новый дизайн на порядок современнее и уж точно лучше, чем у большинства коллег по цеху.",
                "image" => "/source/uploadImg/posts/6.jpg",
                "headings_id" => 3,
                "import_id" => 1,
                "approved" => "yes",
            ],
        ];

        $tidings = [
            [
                "post_id"   => 1,
                "tag_id"    => 1
            ],
            [
                "post_id"   => 1,
                "tag_id"    => 3
            ],
            [
                "post_id"   => 2,
                "tag_id"    => 4
            ],
            [
                "post_id"   => 2,
                "tag_id"    => 3
            ],
            [
                "post_id"   => 3,
                "tag_id"    => 1
            ],
            [
                "post_id"   => 3,
                "tag_id"    => 2
            ],
            [
                "post_id"   => 4,
                "tag_id"    => 1
            ],
            [
                "post_id"   => 5,
                "tag_id"    => 4
            ],
            [
                "post_id"   => 5,
                "tag_id"    => 2
            ],
            [
                "post_id"   => 6,
                "tag_id"    => 1
            ],
            [
                "post_id"   => 6,
                "tag_id"    => 2
            ],
            [
                "post_id"   => 6,
                "tag_id"    => 3
            ],
        ];

        if (\App\Models\Post::all()->count() < 1){

            foreach ($posts as $post) {
                \App\Models\Post::create($post);
            }

        }

        if (\App\Models\Tidings::all()->count() < 1){

            foreach ($tidings as $tiding) {
                \App\Models\Tidings::create($tiding);
            }

        }

    }
}
