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
        Schema::create('productos', function (Blueprint $table) {
            $table->bigIncrements('id');;
            $table->string('nombre');
            $table->longText('descripcion');
            $table->string('envase');
            $table->longText('image');
            $table->integer('total_pay');
            $table->date('created_at')->default(now()); // Cambio a tipo de dato "date"


        });

        DB::table('productos')->insert([
            [
                'id' => 1,
                'nombre' => 'Camarón 36/40',
                'descripcion' => 'Este es el camarón 36/40. Es un delicioso camarón de tamaño medio.',
                'envase' => 'Caja',
                'image' => 'http://127.0.0.1:8000/assets/img/camaron3640.jpg',
                'total_pay' => 3
            ],
            [
                'id' => 2,
                'nombre' => 'Salmon Filete',
                'descripcion' => 'Este es el camarón 36/40. Es un delicioso camarón de tamaño medio.',
                'envase' => 'Al vacío',
                'image' => 'http://127.0.0.1:8000/assets/img/salmonfilete.jpg',
                'total_pay' => 3
            ],
            [
                'id' => 3,
                'nombre' => 'Camarón 100/150',
                'descripcion' => 'Este es el camarón 100/150. Es un camarón de gran tamaño, ideal para platos fuertes.',
                'envase' => 'Caja',
                'image' => 'http://127.0.0.1:8000/assets/img/camaron100150.jpg',
                'total_pay' => 3
            ],
            [
                'id' => 4,
                'nombre' => 'Reienta',
                'descripcion' => 'La reineta es un pescado de tamaño medio a grande con piel marrón oscuro o gris en la parte superior y plateada en la parte inferior. Su carne blanca y suave tiene un sabor dulce y delicado que se presta bien a una variedad de preparaciones culinarias.',
                'envase' => 'Al Vacío',
                'image' => 'https://aperitivo.cl/wp-content/uploads/2020/07/REINETA-OK-WEB.jpg',
                'total_pay' => 3
            ],
            [
                'id' => 5,
                'nombre' => 'Merluza',
                'descripcion' => 'Tiene una carne firme y blanca con un sabor suave y dulce que la hace muy versátil en la cocina. Es una opción popular para platos tanto fritos como a la parrilla, y es conocida por su valor nutricional, ya que es una buena fuente de proteínas y ácidos grasos omega-3.',
                'envase' => 'Al vacío',
                'image' => 'https://www.hogarmania.com/archivos/202207/filetear-merluza-1-668x400x80xX-1.jpg',
                'total_pay' => 3
            ],
            [
                'id' => 6,
                'nombre' => 'Surtido de mariscos',
                'descripcion' => 'Este surtido de mariscos es una selección de diferentes tipos de mariscos, que pueden incluir camarones, almejas, mejillones, cangrejos, langostinos, pulpo, calamares, entre otros. Suele ser un plato muy apreciado en la gastronomía de diversas culturas, ya que los mariscos son una fuente de proteínas y minerales, además de ser una deliciosa opción para degustar en diferentes preparaciones culinarias como paellas, arroces, fideuás, ceviches, entre otros. Un surtido de mariscos puede ser presentado como un plato principal o como una entrada en una comida o cena especial.',
                'envase' => 'Caja',
                'image' => 'https://todobaratotc.cl/wp-content/uploads/2020/10/10.png',
                'total_pay' => 3
            ],
            [
                'id' => 7,
                'nombre' => 'Queso crema',
                'descripcion' => 'Este es el queso crema. Es un queso cremoso y delicioso, perfecto para untar en tus comidas favoritas.',
                'envase' => 'Caja',
                'image' => 'http://127.0.0.1:8000/assets/img/quesocrema.jpg',
                'total_pay' => 3
            ],
            // Agrega más registros aquí
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
