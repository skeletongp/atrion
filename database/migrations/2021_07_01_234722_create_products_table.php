<?php

use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('code', 100)->unique()->nullable();
            $table->string('meta');
            $table->integer('stock');
            $table->decimal('cost');
            $table->decimal('price');
            $table->string('slug');
            $table->foreignId('place_id')->constrained();
            $table->foreignId('category_id')->constrained();
            $table->foreignId('edited_by')->nullable()->constrained('users','id');
            $table->softDeletes();
            $table->enum('type',[Product::PRODUCTO, Product::SERVICIO])->default(Product::PRODUCTO);
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
        Schema::dropIfExists('products');
    }
}
