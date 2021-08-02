<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('client_id');
            $table->decimal('amount', 18,2);
            $table->date('date');
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
            $table->foreign('place_id')
            ->references('id')
            ->on('places');
            $table->foreign('client_id')
            ->references('id')
            ->on('clients');
            $table->softDeletes();
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
        Schema::dropIfExists('incomes');
    }
}
