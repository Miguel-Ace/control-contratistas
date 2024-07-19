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
        Schema::create('empleados', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_contratista')->unsigned();
            $table->string('nombres');
            $table->string('apellidos');
            $table->string('cedula');
            $table->bigInteger('id_tipo_cedula')->unsigned();
            $table->string('telefono');
            $table->string('email');
            $table->string('direccion');
            $table->string('num_seguro');
            $table->timestamps();

            $table->foreign('id_contratista')->references('id')->on('contratistas');
            $table->foreign('id_tipo_cedula')->references('id')->on('tipo_cedulas');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('empleados');
    }
};
