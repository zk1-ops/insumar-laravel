<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $fillable = ['business_name', 'dni', 'contact_person','contact_mail', 'contact_phone', 'city', 'address', 'created_at', 'updated_at' ];

}
