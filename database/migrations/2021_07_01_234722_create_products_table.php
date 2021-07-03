<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('meta');
            $table->integer('stock');
            $table->decimal('cost');
            $table->decimal('price');
            $table->string('slug');
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('provider_id');
            $table->tinyInteger('is_active');
            $table->foreign('place_id')
            ->references('id')
            ->on('places');
            $table->foreign('category_id')
            ->references('id')
            ->on('categories');
            $table->foreign('provider_id')
            ->references('id')
            ->on('providers');
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
        Schema::dropIfExists('products');
    }
}
