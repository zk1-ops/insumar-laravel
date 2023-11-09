<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('suppliers', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('business_name');
            $table->string('dni');
            $table->string('contact_person');
            $table->string('contact_mail');
            $table->string('contact_phone');
            $table->string('city');
            $table->string('address');
            $table->timestamps();
        });

        DB::table('suppliers')->insert([
            [
                'id' => 1,
                'business_name' => 'Distribuidor 1',
                'dni' => '66.345.765-2',
                'contact_person' => 'Alfredo Gomez',
                'contact_mail' => 'distribuidor1@mail.com',
                'contact_phone' => '+569 923423',
                'city' => 'Corral', 
                'address' => 'Direccion asdsad N 123'
            ],
            [
                'id' => 2,
                'business_name' => 'Distribuidor 2',
                'dni' => '22.756.345-7',
                'contact_person' => 'Miguel Vasquez',
                'contact_mail' => 'distribuidor2@mail.com',
                'contact_phone' => '+569 876586',
                'city' => 'Angelmo', 
                'address' => 'Direccion kngfd4 N 562'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('suppliers');
    }
};
