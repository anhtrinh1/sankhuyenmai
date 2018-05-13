<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Coupon extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         Schema::create('Coupon', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('title');
            $table->date('start_day')->nullable();
            $table->date('end_day');
            $table->string('coupon_code')->nullable();
            $table->string('link_img');
            $table->string('percent');
            $table->text('link');
            $table->bigInteger('number_click')->default(0);
            $table->text('notes')->nullable();
            $table->boolean('display')->default(true);
            $table->timestamps();
            $table->string('id_category');
            $table->string('id_type');
            $table->string('id_shop');
            $table->integer('id_user_create');
            $table->integer('id_user_update')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('Coupon');
    }
}
