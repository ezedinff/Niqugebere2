<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePushesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    { Schema::create('pushes', function (Blueprint $table) {
        $table->increments('id');
        $table->integer("woreda_id");
        $table->integer("product_category_id");
        $table->integer("quantity");
        $table->string("phone_number");
        $table->string("delivery_time");
        $table->string("description");
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
        Schema::dropIfExists('pushes');
    }
}
