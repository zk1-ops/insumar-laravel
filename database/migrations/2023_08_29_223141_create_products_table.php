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
        Schema::create('products', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_supplier');
            $table->string('name');
            $table->longText('description');
            $table->integer('stock')->default(0);
            $table->string('container');
            $table->longText('image');
            $table->integer('price');
            $table->boolean('show_product')->default(true);
            $table->date('fecha_ingreso')->default(now());
            $table->date('fecha_vencimiento');

            $table->foreign('id_supplier')->references('id')->on('suppliers');


        });

        DB::table('products')->insert([
            [
                'id' => 1,
                'id_supplier' => 1,
                'name' => 'Camarón 36/40',
                'description' => 'Este es el camarón 36/40. Es un delicioso camarón de tamaño medio.',
                'stock' => 50,
                'container' => 'Bandeja',
                'image' => '/storage/images/product/camaron3640.jpg',
                'price' => 3,
                'fecha_vencimiento' => '2023-12-30'
            ],
            [
                'id' => 2,
                'id_supplier' => 1,
                'name' => 'Salmon Filete',
                'description' => 'Este es el camarón 36/40. Es un delicioso camarón de tamaño medio.',
                'stock' => 50,
                'container' => 'Bandeja',
                'image' => '/storage/images/product/salmonfilete.jpg',
                'price' => 3,
                'fecha_vencimiento' => '2023-12-30'
            ],
            [
                'id' => 3,
                'id_supplier' => 1,
                'name' => 'Camarón 100/150',
                'description' => 'Este es el camarón 100/150. Es un camarón de gran tamaño, ideal para platos fuertes.',
                'stock' => 50,
                'container' => 'Bandeja',
                'image' => '/storage/images/product/camaron100150.jpg',
                'price' => 3,
                'fecha_vencimiento' => '2023-12-30'
            ],
            [
                'id' => 4,
                'id_supplier' => 1,
                'name' => 'Reienta',
                'description' => 'La reineta es un pescado de tamaño medio a grande con piel marrón oscuro o gris en la parte superior y plateada en la parte inferior. Su carne blanca y suave tiene un sabor dulce y delicado que se presta bien a una variedad de preparaciones culinarias.',
                'stock' => 50,
                'container' => 'Bandeja',
                'image' => 'https://aperitivo.cl/wp-content/uploads/2020/07/REINETA-OK-WEB.jpg',
                'price' => 3,
                'fecha_vencimiento' => '2023-12-30'
            ],
            [
                'id' => 5,
                'id_supplier' => 1,
                'name' => 'Merluza',
                'description' => 'Tiene una carne firme y blanca con un sabor suave y dulce que la hace muy versátil en la cocina. Es una opción popular para platos tanto fritos como a la parrilla, y es conocida por su valor nutricional, ya que es una buena fuente de proteínas y ácidos grasos omega-3.',
                'stock' => 50,
                'container' => 'Bandeja',
                'image' => 'https://www.hogarmania.com/archivos/202207/filetear-merluza-1-668x400x80xX-1.jpg',
                'price' => 3,
                'fecha_vencimiento' => '2023-12-30'
            ],
            [
                'id' => 6,
                'id_supplier' => 2,
                'name' => 'Surtido de mariscos',
                'description' => 'Este surtido de mariscos es una selección de diferentes tipos de mariscos, que pueden incluir camarones, almejas, mejillones, cangrejos, langostinos, pulpo, calamares, entre otros. Suele ser un plato muy apreciado en la gastronomía de diversas culturas, ya que los mariscos son una fuente de proteínas y minerales, además de ser una deliciosa opción para degustar en diferentes preparaciones culinarias como paellas, arroces, fideuás, ceviches, entre otros. Un surtido de mariscos puede ser presentado como un plato principal o como una entrada en una comida o cena especial.',
                'stock' => 50,
                'container' => 'Bandeja',
                'image' => 'https://todobaratotc.cl/wp-content/uploads/2020/10/10.png',
                'price' => 3,
                'fecha_vencimiento' => '2023-12-30'
            ],
            // Agrega más registros aquí
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
