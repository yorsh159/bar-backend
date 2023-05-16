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
        Schema::create('comision_nota_detalle', function (Blueprint $table) {
            $table->id();
            $table->foreignId('comisiones_id')->constrained()->onDelete('cascade');
            $table->foreignId('pedido_id')->constrained()->onDelete('cascade');
            $table->string('mesa');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comision_nota_detalle');
    }
};
