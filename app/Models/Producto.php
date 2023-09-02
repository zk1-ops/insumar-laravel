<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    public $timestamps = false; // Will not modify the timestamps on save

    protected $table = 'productos';

    protected $fillable = [
        'nombre',
        'descripcion',
        'envase',
        'total_pay',
        'created_at'
    ];
}
