<?php

use Illuminate\Database\Seeder;

class AppendRubricsAndTagsAndImp extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $rubs = [
            [
                "heading"       => "politics",
                "heading_name"  => "Политика",
            ],
            [
                "heading"       => "humor",
                "heading_name"  => "Юмор",
            ],
            [
                "heading"       => "religion",
                "heading_name"  => "Религия",
            ],
            [
                "heading"       => "bussines",
                "heading_name"  => "Бизнес",
            ],
            [
                "heading"       => "other",
                "heading_name"  => "Разное",
            ],
        ];

        $tags = [
            [
                "tag"       => "culture",
                "tag_name"  => "Культура",
            ],
            [
                "tag"       => "video",
                "tag_name"  => "Видео",
            ],
            [
                "tag"       => "music",
                "tag_name"  => "Музыка",
            ],
            [
                "tag"       => "other",
                "tag_name"  => "Разное",
            ],
        ];

        $importances = [
            [
                "import"        => "very_import",
                "import_name"   => "Очень важное",
            ],
            [
                "import"        => "not_very_import",
                "import_name"   => "Не очень важное",
            ],
            [
                "import"        => "not_import",
                "import_name"   => "Не важное",
            ],
        ];

        if (\App\Models\Heading::all()->count() < 1){

            foreach ($rubs as $rub) {
                \App\Models\Heading::create($rub);
            }

        }

        if (\App\Models\Tag::all()->count() < 1){

            foreach ($tags as $tag) {
                \App\Models\Tag::create($tag);
            }

        }

        if (\App\Models\Importance::all()->count() < 1){

            foreach ($importances as $importance) {
                \App\Models\Importance::create($importance);
            }

        }



    }
}
