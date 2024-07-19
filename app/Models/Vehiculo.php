<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = 'vehiculos';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'id_contratista',
        'marca',
        'modelo',
        'color',
        'placa',
    ];

    function contratistas(){
        return $this->belongsTo(Contratista::class,'id_contratista');
    }
}
