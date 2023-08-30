<template>
    <v-container>
        <!-- <h2 class="text-sm-h2" style="color: black;">LACOM - COMERCIALIZADORA SANTA LUISA</h2> -->
        <!-- <br> -->
        <v-row align="center" justify="center">
            <v-col md="5" cols="8">
                <v-img style="left: 15%;" src="http://127.0.0.1:8000/assets/img/logo1.jpg" class="rounded-xl rotate-image ma-auto" width="45%"></v-img>
            </v-col>
            <v-col md="5" cols="8" class="text-body-1 text-justify">
                <p>
                    Somos una empresa ubicada en Laja, dedicada a ofrecer productos de alta calidad en el mercado de los congelados.
                </p><br>
                <p>
                    Nuestro compromiso es brindar a nuestros clientes una amplia variedad de opciones congeladas, garantizando siempre la frescura y calidad de nuestros productos. 
                    Con años de experiencia en el sector, hemos construido una sólida reputación como proveedores confiables y líderes en el mercado.
                </p><br>
                <p>
                    Nos enorgullece ofrecer productos de calidad y un servicio excepcional para satisfacer las necesidades de nuestros clientes. 
                </p><br>
                <p>
                    ¡Esperamos tener la oportunidad de servirles y demostrarles por qué somos la mejor opción en el mercado de los congelados!"
                </p>
            </v-col>
        </v-row>
    </v-container>
</template>
<style>

.rotate-image {
  animation: rotate 3.5s ease-out forwards;
}

.rotate-image {
  animation: rotate 3.5s ease-out forwards;
}

@keyframes rotate {
  0% {
    transform: rotateY(0deg);
  }
  50% {
    transform: rotateY(280deg);
  }
  100% {
    transform: rotateY(360deg);
  }
}

.rotate-image.finished {
  transform: rotateY(0deg);
}

</style>