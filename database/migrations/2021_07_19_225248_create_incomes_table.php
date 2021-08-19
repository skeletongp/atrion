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
            $table->decimal('amount', 18,2);
            $table->date('date');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('place_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('cash_id')->constrained();
            $table->foreignId('edited_by')->nullable()->constrained('users','id');  
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
        Schema::dropIfExists('incomes');
    }
}
