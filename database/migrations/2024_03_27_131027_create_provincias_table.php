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
        Schema::create('tb_provincia', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 60);
            $table->string('ubigeo', 6);
            $table->unsignedBigInteger('departamento_id');
            $table->foreign('departamento_id')->references('id')->on('tb_departamento');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_provincia');
    }
};
