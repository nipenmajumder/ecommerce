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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string("slug")->unique();
            $table->string('sku')->unique();
            $table->string('barcode')->unique();
            $table->string('image')->nullable();
            $table->text('description')->nullable();
            $table->foreignId('author_id')->nullable()
                ->constrained('authors', 'id')
                ->onDelete('set null');
            $table->foreignId('publication_id')->nullable()
                ->constrained('publications', 'id')
                ->onDelete('set null');
            $table->decimal('buy_price', 15, 2)->default(0);
            $table->decimal('sell_price', 15, 2)->default(0);
            $table->tinyInteger('status')->default(1);
            $table->foreignId('created_by')->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
            $table->foreignId('updated_by')->nullable()
                ->constrained('users', 'id')
                ->onDelete('set null');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
