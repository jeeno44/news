<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableHeadings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('headings', function (Blueprint $table) {
            $table->increments('id');
            $table->string("heading")->nullable(false);
            $table->string("heading_name")->nullable(false);
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
        Schema::dropIfExists('headings');
    }
}
