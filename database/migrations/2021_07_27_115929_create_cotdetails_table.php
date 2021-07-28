<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotdetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotdetails', function (Blueprint $table) {
            $table->id();
            $table->integer('cant');
            $table->decimal('discount', 18,2);
            $table->decimal('tax', 18,2);
            $table->decimal('subtotal', 18,2);
            $table->decimal('total', 18,2);
            $table->decimal('price', 18,2);
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('cotize_id');
            $table->foreign('product_id')
            ->references('id')
            ->on('products');
            $table->foreign('cotize_id')
            ->references('id')
            ->on('cotizes');
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
        Schema::dropIfExists('cotdetails');
    }
}
