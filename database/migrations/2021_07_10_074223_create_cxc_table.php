<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCxcTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cxcs', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount', 18,2);
            $table->decimal('balance', 18,2);
            $table->foreignId('client_id')->constrained();
            $table->foreignId('edited_by')->nullable()->constrained('users','id');
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
        Schema::dropIfExists('cxcs');
    }
}
