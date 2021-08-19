<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChargesTable extends Migration
{
    public function up()
    {
        Schema::create('charges', function (Blueprint $table) {
            $table->id();
            $table->decimal('amount');
            $table->foreignId('cxp_id')->constrained();
            $table->foreignId('edited_by')->nullable()->constrained('users','id');
            $table->timestamps();
        });
    }
    public function down()
    {
        Schema::dropIfExists('charges');
    }
}
