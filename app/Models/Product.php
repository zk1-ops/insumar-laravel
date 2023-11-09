<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public $timestamps = false; // Will not modify the timestamps on save

    protected $table = 'products';

    protected $fillable = [
        'name',
        'id_supplier',
        'description',
        'container',
        'stock',
        'price',
        'image',
        'show_product',
        'fecha_ingreso'
    ];
}
