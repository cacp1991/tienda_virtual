<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {
        Schema::create('carrodecompras', function (Blueprint $table) {
            $table->bigIncrements('id');
			$table->unsignedBigInteger('category_id')->nullable();
			$table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('product_id')->nullable();
			$table->foreign('product_id')->references('id')->on('products')->onDelete('cascade')->onUpdate('cascade');
			$table->unsignedBigInteger('user_id')->nullable();
			$table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
			$table->integer('price')->nullable();
			$table->integer('quantity')->default(1);
			$table->timestamps();
        });
    }


    public function down()
    {
        Schema::dropIfExists('carrodecompras');
    }
};
