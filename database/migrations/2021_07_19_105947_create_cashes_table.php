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
            $table->softDeletes();  
            $table->tinyInteger('status')->default(1);  
            $table->decimal('start', 18,2);
            $table->decimal('end', 18,2)->nullable();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('place_id')->constrained();
            $table->foreignId('edited_by')->nullable()->constrained('users','id');
            $table->string('local_ip');
            $table->timestamps();
       
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('cashes');
    }
}
