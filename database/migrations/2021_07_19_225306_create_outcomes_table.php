<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outcomes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('place_id');
            $table->unsignedBigInteger('provider_id');
            $table->decimal('amount', 18,2);
            $table->date('date');
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
            $table->foreign('place_id')
            ->references('id')
            ->on('places');
            $table->foreign('provider_id')
            ->references('id')
            ->on('providers');
            $table->softDeletes();
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
        Schema::dropIfExists('outcomes');
    }
}
