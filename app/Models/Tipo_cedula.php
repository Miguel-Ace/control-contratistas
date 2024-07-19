<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_cedula extends Model
{
    use HasFactory;

    protected $table = 'tipo_cedulas';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'tipo_cedula',
    ];
}
