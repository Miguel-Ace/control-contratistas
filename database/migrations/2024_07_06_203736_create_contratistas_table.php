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
        Schema::create('contratistas', function (Blueprint $table) {
            $table->id();
            $table->string('nombre_empresa');
            $table->bigInteger('id_tipo_cedula')->unsigned();
            $table->bigInteger('id_user')->unsigned();
            $table->string('telefono_empresa');
            $table->string('cedula_empresa');
            $table->string('direccion_empresa');
            $table->string('barrio');
            $table->bigInteger('id_canton')->unsigned();
            $table->bigInteger('id_provincia')->unsigned();
            $table->string('web')->nullable();
            $table->string('nombre_contratista');
            $table->string('cedula_contratista');
            $table->string('telefono_contratista');
            $table->string('correo_contratista')->nullable();
            $table->string('documento_ins');
            $table->string('documento_ccss');
            $table->string('fecha_ini')->nullable();
            $table->string('fecha_fin')->nullable();
            $table->boolean('activo')->nullable();
            $table->timestamps();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_tipo_cedula')->references('id')->on('tipo_cedulas');
            $table->foreign('id_canton')->references('id')->on('cantones');
            $table->foreign('id_provincia')->references('id')->on('provincias');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratistas');
    }
};
