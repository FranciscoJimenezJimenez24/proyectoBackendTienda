<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venta extends Model
{
    protected $table = 'ventas';

    protected $casts = [
        'lista_productos' => 'array',
    ];

    protected $fillable = [
        'id_usuario',
        'lista_productos',
        'total',
        'estado_venta',
    ];
}
