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
                "headline" => "Заголовок",
                "subheadline" => "Подзаголовок",
                "post" => "Some text",
                "image" => "/source/img/img.jpg",
                "headings_id" => 1,
                "import_id" => 1,
                "approved" => "yes",
            ],
            [
                "user_id" => $lastEditor,
                "headline" => "Заголовок2",
                "subheadline" => "Подзаголовок2",
                "post" => "Some text2",
                "image" => "/source/img/img.jpg",
                "headings_id" => 1,
                "import_id" => 1,
                "approved" => "yes",
            ],
            [
                "user_id" => $lastEditor,
                "headline" => "Заголовок3",
                "subheadline" => "Подзаголовок3",
                "post" => "Some text3",
                "image" => "/source/img/img.jpg",
                "headings_id" => 1,
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
