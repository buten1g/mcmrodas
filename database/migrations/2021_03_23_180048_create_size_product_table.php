<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSizeProductTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('size_product', function (Blueprint $table) {
            $table->primary(['size_id','product_id']);
            $table->integer('size_id')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->timestamps();
            $table->foreign('size_id')
                ->references('id')
                ->on('sizes');
             $table->foreign('product_id')
                ->references('id')
                ->on('products');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('size_product');
    }
}
