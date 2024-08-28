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
        Schema::create('productos_facturas', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_producto')
            ->nullable()
            ->constrained('productos')
            ->cascadeOnUpdate()
            ->nullOnDelete();

            $table->foreignId('id_factura')
            ->nullable()
            ->constrained('facturas')
            ->cascadeOnUpdate()
            ->nullOnDelete();

            $table->double('descuento');

            $table->double('precio_total');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos_facturas');
    }
};
