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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->string('invoice');
            $table->foreignId('user_id')->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
            $table->double('total_quantity');
            $table->double('subtotal');
            $table->double('total');
            $table->string('note');
            $table->tinyInteger('status')
                ->default(1)
                ->comment('1: Pending, 2: Processing, 3: Completed, 4: Cancelled, 5: Refunded');
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
        Schema::dropIfExists('orders');
    }
};
