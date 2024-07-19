<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documento extends Model
{
    use HasFactory;

    protected $table = 'documentos';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_contratista',
        'id_empleado',
        'id_vehiculo',
        'fecha_vencimiento',
        'observacion',
        'attach',
    ];

    function contratistas(){
        return $this->belongsTo(Contratista::class,'id_contratista');
    }

    function empleados(){
        return $this->belongsTo(Empleado::class,'id_empleado');
    }

    function vehiculos(){
        return $this->belongsTo(Vehiculo::class,'id_vehiculo');
    }
}
