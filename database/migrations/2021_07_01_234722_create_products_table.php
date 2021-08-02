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
            $table->string('code', 100)->unique()->nullable();
            $table->string('meta');
            $table->integer('stock');
            $table->decimal('cost');
            $table->decimal('price');
            $table->string('slug');
           
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('category_id');
            $table->softDeletes();
            $table->tinyInteger('is_product')->default(1);
            $table->foreign('place_id')
            ->references('id')
            ->on('places');
            $table->foreign('category_id')
            ->references('id')
            ->on('categories');
            
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamps();
            $table->foreign('edited_by')
            ->references('id')
            ->on('users');
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
