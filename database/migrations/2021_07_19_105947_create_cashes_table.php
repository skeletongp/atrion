<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCashesTable extends Migration
{
    
    public function up()
    {
        Schema::create('cashes', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('place_id');
            $table->softDeletes();  
            $table->tinyInteger('status')->default(1);  
            $table->decimal('start', 18,2);
            $table->decimal('end', 18,2)->nullable();
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
            $table->foreign('place_id')
            ->references('id')
            ->on('places');
            $table->unsignedBigInteger('edited_by')->nullable();
            $table->timestamps();
            $table->foreign('edited_by')
            ->references('id')
            ->on('users');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('cashes');
    }
}
