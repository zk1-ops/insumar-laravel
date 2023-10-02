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
            $table->bigIncrements('id');;
            $table->string('name');
            $table->longText('description');
            $table->integer('stock');
            $table->string('container');
            $table->longText('image');
            $table->integer('price');
            $table->boolean('show_product')->default(true);
            $table->date('created_at')->default(now());

        });

        DB::table('products')->insert([
            [
                'id' => 1,
                'name' => 'Camarón 36/40',
                'description' => 'Este es el camarón 36/40. Es un delicioso camarón de tamaño medio.',
                'stock' => 50,
                'container' => 'Caja',
                'image' => '/storage/images/product/camaron3640.jpg',
                'price' => 3
            ],
            [
                'id' => 2,
                'name' => 'Salmon Filete',
                'description' => 'Este es el camarón 36/40. Es un delicioso camarón de tamaño medio.',
                'stock' => 50,
                'container' => 'Al vacío',
                'image' => '/storage/images/product/salmonfilete.jpg',
                'price' => 3
            ],
            [
                'id' => 3,
                'name' => 'Camarón 100/150',
                'description' => 'Este es el camarón 100/150. Es un camarón de gran tamaño, ideal para platos fuertes.',
                'stock' => 50,
                'container' => 'Caja',
                'image' => '/storage/images/product/camaron100150.jpg',
                'price' => 3
            ],
            [
                'id' => 4,
                'name' => 'Reienta',
                'description' => 'La reineta es un pescado de tamaño medio a grande con piel marrón oscuro o gris en la parte superior y plateada en la parte inferior. Su carne blanca y suave tiene un sabor dulce y delicado que se presta bien a una variedad de preparaciones culinarias.',
                'stock' => 50,
                'container' => 'Al Vacío',
                'image' => 'https://aperitivo.cl/wp-content/uploads/2020/07/REINETA-OK-WEB.jpg',
                'price' => 3
            ],
            [
                'id' => 5,
                'name' => 'Merluza',
                'description' => 'Tiene una carne firme y blanca con un sabor suave y dulce que la hace muy versátil en la cocina. Es una opción popular para platos tanto fritos como a la parrilla, y es conocida por su valor nutricional, ya que es una buena fuente de proteínas y ácidos grasos omega-3.',
                'stock' => 50,
                'container' => 'Al vacío',
                'image' => 'https://www.hogarmania.com/archivos/202207/filetear-merluza-1-668x400x80xX-1.jpg',
                'price' => 3
            ],
            [
                'id' => 6,
                'name' => 'Surtido de mariscos',
                'description' => 'Este surtido de mariscos es una selección de diferentes tipos de mariscos, que pueden incluir camarones, almejas, mejillones, cangrejos, langostinos, pulpo, calamares, entre otros. Suele ser un plato muy apreciado en la gastronomía de diversas culturas, ya que los mariscos son una fuente de proteínas y minerales, además de ser una deliciosa opción para degustar en diferentes preparaciones culinarias como paellas, arroces, fideuás, ceviches, entre otros. Un surtido de mariscos puede ser presentado como un plato principal o como una entrada en una comida o cena especial.',
                'stock' => 50,
                'container' => 'Caja',
                'image' => 'https://todobaratotc.cl/wp-content/uploads/2020/10/10.png',
                'price' => 3
            ],
            [
                'id' => 7,
                'name' => 'Queso crema',
                'description' => 'Este es el queso crema. Es un queso cremoso y delicioso, perfecto para untar en tus comidas favoritas.',
                'stock' => 50,
                'container' => 'Caja',
                'image' => '/storage/images/product/quesocrema.jpg',
                'price' => 3
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
