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
        Schema::create('cart_productos', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_cart')
            ->nullable()
            ->constrained('carts')
            ->cascadeOnUpdate()
            ->nullOnDelete();

            $table->foreignId('id_producto')
            ->nullable()
            ->constrained('productos')
            ->cascadeOnUpdate()
            ->nullOnDelete();

            $table->integer('cantidad');

            $table->decimal('descuento', 8, 2);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_productos');
    }
};
