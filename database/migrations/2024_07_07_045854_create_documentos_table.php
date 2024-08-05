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
        Schema::create('documentos', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_contratista')->unsigned();
            $table->bigInteger('id_empleado')->unsigned();
            $table->bigInteger('id_vehiculo')->unsigned();
            $table->bigInteger('id_tipo_documentos')->unsigned();
            $table->string('fecha_vencimiento');
            $table->text('observacion')->nullable();
            $table->text('num_documento');
            $table->string('attach');
            $table->timestamps();

            $table->foreign('id_contratista')->references('id')->on('contratistas');
            $table->foreign('id_empleado')->references('id')->on('empleados');
            $table->foreign('id_vehiculo')->references('id')->on('vehiculos');
            $table->foreign('id_tipo_documentos')->references('id')->on('tipo_documentos');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('documentos');
    }
};
