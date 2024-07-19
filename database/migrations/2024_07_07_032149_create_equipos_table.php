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
        Schema::create('equipos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_contratista')->unsigned();
            $table->bigInteger('id_tipo_equipo')->unsigned();
            $table->string('equipo');
            $table->string('numero_serie')->nullable();
            $table->timestamps();

            $table->foreign('id_contratista')->references('id')->on('contratistas');
            $table->foreign('id_tipo_equipo')->references('id')->on('tipo_equipos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipos');
    }
};
