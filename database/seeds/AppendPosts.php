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
        $lastEditor = DB::table("users")->where("role_id",2)->first()->id;

        $posts = [
            [
                "user_id" => $lastEditor,
                "headline" => "Заголовок (Политика)",
                "subheadline" => "Подзаголовок (Политика)",
                "post" => "Some text",
                "image" => "/source/img/img.jpg",
                "headings_id" => 1,
                "import_id" => 1,
                "approved" => "yes",
            ],
            [
                "user_id" => $lastEditor,
                "headline" => "Заголовок2 (Политика)",
                "subheadline" => "Подзаголовок2 (Политика)",
                "post" => "Some text2",
                "image" => "/source/img/img.jpg",
                "headings_id" => 1,
                "import_id" => 1,
                "approved" => "yes",
            ],
            [
                "user_id" => $lastEditor,
                "headline" => "Заголовок3 (Политика)",
                "subheadline" => "Подзаголовок3 (Политика)",
                "post" => "Some text3",
                "image" => "/source/img/img.jpg",
                "headings_id" => 1,
                "import_id" => 1,
                "approved" => "yes",
            ],
            [
                "user_id" => $lastEditor,
                "headline" => "Заголовок (Юмор)",
                "subheadline" => "Подзаголовок (Юмор)",
                "post" => "Some text3",
                "image" => "/source/img/img.jpg",
                "headings_id" => 2,
                "import_id" => 1,
                "approved" => "yes",
            ],
            [
                "user_id" => $lastEditor,
                "headline" => "Заголовок2 (Юмор)",
                "subheadline" => "Подзаголовок2 (Юмор)",
                "post" => "Some text3",
                "image" => "/source/img/img.jpg",
                "headings_id" => 2,
                "import_id" => 1,
                "approved" => "yes",
            ],
            [
                "user_id" => $lastEditor,
                "headline" => "Заголовок (Религия)",
                "subheadline" => "Подзаголовок (Религия)",
                "post" => "Some text3",
                "image" => "/source/img/img.jpg",
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
