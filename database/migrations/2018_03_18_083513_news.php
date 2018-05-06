<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class News extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('News', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->string('description');
            $table->text('content');
            $table->string('link_img');
            $table->string('id_type_new',50);
            $table->timestamps();
            $table->bigInteger('views')->default(0);
            $table->boolean('news_feed')->default(false);
            $table->boolean('display')->default(false);
            $table->integer('id_user_create');
            $table->integer('id_user_update')->nullable();
            $table->string('id_category');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('News');
    }
}
