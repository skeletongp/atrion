<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCotizesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cotizes', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->date('date');
            $table->decimal('subtotal', 18,2);
            $table->decimal('tax', 18,2);
            $table->decimal('total', 18,2);
            $table->softDeletes();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('cash_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('place_id')->constrained();
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
        Schema::dropIfExists('cotizes');
    }
}
