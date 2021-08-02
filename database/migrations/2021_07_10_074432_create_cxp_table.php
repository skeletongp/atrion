<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCxpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cxps', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('provider_id');
            $table->decimal('amount', 18,2);
            $table->decimal('balance', 18,2);
            $table->foreign('provider_id')
            ->references('id')
            ->on('providers');
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
        Schema::dropIfExists('cxps');
    }
}
