<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateTableTidings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tidings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('post_id')->unsigned()->nullable(false)->index();
            $table->foreign('post_id')->references('id')->on('posts');
            $table->integer('tag_id')->unsigned()->nullable(false)->index();
            $table->foreign('tag_id')->references('id')->on('tags');
            $table->timestamp("created_at")->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp("updated_at")->nullable(false)->default(DB::raw('CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tidings');
    }
}
