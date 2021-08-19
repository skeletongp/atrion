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
            $table->decimal('payed', 18,2);
            $table->decimal('rest', 18,2);
            $table->decimal('cash',18,2);
            $table->decimal('other',18,2); 
            $table->decimal('refund', 18,2);
            $table->tinyInteger('is_fiscal')->default(0);
            $table->string('type')->default('sale');
            $table->softDeletes();
            $table->foreignId('user_id')->constrained();
            $table->foreignId('client_id')->constrained();
            $table->foreignId('seller_id')->constrained('users','id');
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
        Schema::dropIfExists('invoices');
    }
}
