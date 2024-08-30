<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('bancos', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('metodo_de_pago_id'); // Agregar clave foránea
            $table->string('tipo_de_cuenta');
            $table->integer('numero_de_cuenta');
            $table->foreign('metodo_de_pago_id')
                ->references('id')
                ->on('metodo_de_pago')
                ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('bancos');
    }
};