<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->foreignId('user_id')->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
            $table->foreignId('purchase_id')->nullable()
                ->constrained('purchases', 'id')
                ->onDelete('set null');
            $table->foreignId('product_id')->nullable()
                ->constrained('products', 'id')
                ->onDelete('set null');
            $table->string('product_sku');
            $table->string('product_barcode');
            $table->double('purchase_price');
            $table->double('sell_price');
            $table->tinyInteger('stock_status')->default(1)->comment('1=In Stock, 2=Sold');
            $table->foreignId('created_by')->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
            $table->foreignId('updated_by')->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('stocks');
    }
};
