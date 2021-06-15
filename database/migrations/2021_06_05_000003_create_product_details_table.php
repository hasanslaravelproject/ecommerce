<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_details', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price');
            $table->string('color', 9);
            $table->string('size');
            $table
                ->enum('discount_type', ['percentage', 'flat'])
                ->default('flat')
                ->nullable();
            $table->decimal('discount');
            $table->longText('description');
            $table->unsignedBigInteger('product_id');

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
        Schema::dropIfExists('product_details');
    }
}
