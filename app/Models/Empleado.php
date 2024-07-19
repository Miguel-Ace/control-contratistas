<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empleado extends Model
{
    use HasFactory;

    protected $table = 'empleados';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_contratista',
        'nombres',
        'apellidos',
        'cedula',
        'id_tipo_cedula',
        'telefono',
        'email',
        'direccion',
        'num_seguro'
    ];

    function contratistas(){
        return $this->belongsTo(Contratista::class,'id_contratista');
    }

    function tipos_cedulas(){
        return $this->belongsTo(Tipo_cedula::class,'id_tipo_cedula');
    }
}
