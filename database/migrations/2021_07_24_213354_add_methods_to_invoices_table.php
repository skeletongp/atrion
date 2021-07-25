<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddMethodsToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->decimal('cash',18,2)->after('payed');
            $table->decimal('other',18,2)->after('cash'); 
            $table->unsignedBigInteger('fiscal_id')->nullable()->after('other');
            $table->foreign('fiscal_id')
            ->references('id')
            ->on('fiscals'); 
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropForeign('fiscal_invoice_id_foreign');
           $table->dropColumn('cash','other', 'fiscal_id');
        });
    }
}
