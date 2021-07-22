<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->date('date');
            $table->decimal('subtotal');
            $table->decimal('tax');
            $table->decimal('total');
            $table->string('ncf');
            $table->softDeletes();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('place_id');
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
            $table->foreign('client_id')
            ->references('id')
            ->on('clients');
            $table->foreign('place_id')
            ->references('id')
            ->on('places');
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
        Schema::dropIfExists('invoices');
    }
}
