<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('number');
            $table->date('date');
            $table->decimal('subtotal', 18,2);
            $table->decimal('tax', 18,2);
            $table->decimal('total', 18,2);
        
            $table->tinyInteger('is_fiscal')->default(0);
            $table->string('type')->default('sale');
            $table->softDeletes();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('client_id');
            $table->unsignedBigInteger('place_id');
           
            $table->foreign('user_id')
            ->references('id')
            ->on('users');
            $table->foreign('client_id')
            ->references('id')
            ->on('clients');
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

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
