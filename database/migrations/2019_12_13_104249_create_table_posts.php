<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTablePosts extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned()->nullable(false)->index();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string("headline")->nullable(false);
            $table->string("subheadline")->nullable();
            $table->text("post")->nullable(false);
            $table->string("image")->nullable(false);
            $table->integer('headings_id')->unsigned()->nullable(false)->index();
            $table->foreign('headings_id')->references('id')->on('headings');
            $table->integer('import_id')->unsigned()->nullable(false)->index();
            $table->foreign('import_id')->references('id')->on('importances');
            $table->enum("approved",["yes","no"]);
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
        Schema::dropIfExists('posts');
    }
}
