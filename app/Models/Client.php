<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;


    protected $fillable = ["first_name", "last_name", "business_name", "dni", "email", "phone", "city", "address"];
    public $timestamps = false;
}

