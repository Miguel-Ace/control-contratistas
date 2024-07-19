<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Canton extends Model
{
    use HasFactory;

    protected $table = 'cantones';
    public $timestamps = false;
    
    protected $fillable = [
        'id',
        'canton',
        'id_provincia',
    ];

    function provincias(){
        return $this->belongsTo(Provincia::class,'id_provincia');
    }
}
