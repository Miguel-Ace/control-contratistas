<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipo extends Model
{
    use HasFactory;

    protected $table = 'equipos';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_contratista',
        'id_tipo_equipo',
        'equipo',
        'numero_serie',
    ];

    function contratistas(){
        return $this->belongsTo(Contratista::class,'id_contratista');
    }

    function tipos_equipos(){
        return $this->belongsTo(Tipo_equipo::class,'id_tipo_equipo');
    }
}
