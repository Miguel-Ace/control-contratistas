<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tipo_documento extends Model
{
    use HasFactory;

    protected $table = 'tipo_documentos';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'tipo_documento',
    ];
}
