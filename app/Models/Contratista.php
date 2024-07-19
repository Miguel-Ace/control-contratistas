<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contratista extends Model
{
    use HasFactory;

    protected $table = 'contratistas';
    public $timestamps = false;
    
    protected $fillable = [
        'nombre_empresa', 
        'id_tipo_cedula',
        'id_user',
        'telefono_empresa', 
        'cedula_empresa', 
        'direccion_empresa', 
        'barrio', 
        'id_canton', 
        'id_provincia', 
        'web', 
        'nombre_contratista', 
        'cedula_contratista', 
        'telefono_contratista', 
        'correo_contratista', 
        'documento_ins', 
        'documento_ccss', 
        'fecha_ini', 
        'fecha_fin', 
        'activo'
    ];

    function usuarios(){
        return $this->belongsTo(User::class,'id_user');
    }

    function tipos_cedulas(){
        return $this->belongsTo(Tipo_cedula::class,'id_tipo_cedula');
    }

    function cantones(){
        return $this->belongsTo(Canton::class,'id_canton');
    }

    function provincias(){
        return $this->belongsTo(Provincia::class,'id_provincia');
    }
}
