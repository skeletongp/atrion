<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFiscalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fiscals', function (Blueprint $table) {
            $table->id();
            $table->string('serie');
            $table->string('type_number');
            $table->string('type');
            $table->string('ncf');
            $table->string('secuency');
            $table->softDeletes();
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
        Schema::dropIfExists('fiscals');
    }
}
