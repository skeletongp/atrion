<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToOutcomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('outcomes', function (Blueprint $table) {
            $table->string('concept')->after('amount');
            $table->string('reference')->after('concept');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('outcomes', function (Blueprint $table) {
            $table->dropColumn('concept','reference');
        });
    }
}
