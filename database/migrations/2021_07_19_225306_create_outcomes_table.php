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
            $table->foreignId('user_id')->constrained();
            $table->foreignId('place_id')->constrained();
            $table->foreignId('provider_id')->nullable()->constrained();
            $table->foreignId('client_id')->nullable()->constrained();
           $table->foreignId('edited_by')->nullable()->constrained('users','id');
            $table->decimal('amount', 18,2);
            $table->string('concept');
            $table->string('reference');
            $table->date('date');
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
