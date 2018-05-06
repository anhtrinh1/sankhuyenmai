<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Category extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('Category', function (Blueprint $table) {
            $table->string('id_category')->primary();
            $table->string('name');
            $table->string('icon_class', 50)->nullable();
            $table->integer('id_user_create');
            $table->integer('id_user_update')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
       Schema::dropIfExists('Category');
    }
}
