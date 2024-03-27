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
        Schema::create('tb_products', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('descripcion');
            $table->decimal('precio', 10, 2);
            $table->integer('cantidad');
            $table->string('ruta_imagen');
            $table->string('ruta_factura')->nullable();
            $table->foreignId('user_id');
            $table->foreignId('category_id');
            $table->foreign('user_id')->references('id')->on('tb_usuario')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('tb_categories')->onUpdate('cascade')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_products');
    }
};
