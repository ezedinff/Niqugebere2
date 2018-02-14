<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posted_products', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("company_id");
            $table->integer("product_sub_category_id");
            $table->string("product_name");
            $table->integer("unit_id");
            $table->integer("quantity");
            $table->float("unit_price");
            $table->string("product_photo");
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
        Schema::dropIfExists('posted_products');
    }
}
