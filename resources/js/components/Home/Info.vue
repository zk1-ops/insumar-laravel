<template>
    <v-container>
      <v-row justify="center">
        <v-col cols="12" md="5">
          <p class="text-subtitle-1 text-justify">
            INSUMAR SPA es una empresa dedicada a la venta de productos congelados de alta calidad para su uso en la industria alimentaria. Se especializa en la distribución de productos congelados a restaurantes y otros negocios de la industria alimentaria. 
            La empresa se enorgullece de ofrecer una amplia variedad de opciones de productos congelados, garantizando siempre la frescura y calidad de sus productos.
          </p><br>
          <p>
            Con años de experiencia en el sector, INSUMAR ha construido una sólida reputación como proveedor confiable y líder en el mercado de productos congelados. 
            La empresa está comprometida con brindar un servicio excepcional para satisfacer las necesidades de sus clientes, ofreciendo productos de calidad a precios competitivos.
          </p>
        </v-col>
        <v-col cols="12" md="5">
          <HomeList />
        </v-col>
      </v-row>
      <br />
    </v-container>
  </template>
  <script>
  export default {
    computed: {
      isMobileBreakpoint() {
        return this.$vuetify.breakpoint.mobile;
      },
    },
  };
  </script>
  