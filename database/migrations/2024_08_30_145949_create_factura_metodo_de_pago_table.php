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
        Schema::create('factura_metodo_de_pagos', function (Blueprint $table) {
            $table->id();
            
            $table->foreignId('id_factura')
            ->nullable()
            ->constrained('facturas')
            ->cascadeOnUpdate()
            ->nullOnDelete();

            $table->foreignId('id_metodo_de_pago')
            ->nullable()
            ->constrained('metodo_de_pago')
            ->cascadeOnUpdate()
            ->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factura_metodo_de_pagos');
    }
};
