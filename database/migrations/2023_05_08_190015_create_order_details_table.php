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
        Schema::create('order_details', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                ->nullable()
                ->index()
                ->constrained('users')
                ->onDelete('set null');
            $table->foreignId('order_id')
                ->nullable()
                ->index()
                ->constrained('orders')
                ->onDelete('set null');
            $table->foreignId('product_id')
                ->nullable()
                ->index()
                ->constrained('products')
                ->onDelete('set null');
            $table->double('purchase_price');
            $table->double('sell_price');
            $table->double('quantity');
            $table->double('total');
            $table->foreignId('created_by')
                ->nullable()
                ->index()
                ->constrained('users')
                ->onDelete('set null');
            $table->foreignId('updated_by')
                ->nullable()
                ->index()
                ->constrained('users')
                ->onDelete('set null');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_details');
    }
};
