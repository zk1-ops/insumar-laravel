<template>
  <v-footer class="bg-grey lighten-1" padless>
    <v-container>
      <v-row justify="center" align="center">
        <v-col cols="12" sm="3">
          <v-img
            src="http://127.0.0.1:8000/assets/img/150x150.png"
            max-width="700"
            max-height="150"
            contain
          ></v-img>
        </v-col>
        <v-col cols="12" sm="6" class="text-center">
          <v-row justify="center">
            <v-col cols="auto">
              <v-icon size="22" class="mr-2">mdi-phone</v-icon>
              <span>+569 4996 9062</span><br>
              <v-icon size="22" class="mr-2">mdi-phone</v-icon>
              <span>+569 9584 2293</span>
              
            </v-col>
            <v-col cols="auto">
              <v-icon size="24" class="mx-2">mdi-email</v-icon>
              <span>contacto@insumar-spa.cl</span>
            </v-col>
            <v-col cols="auto">
              <v-icon size="24" class="mx-2">mdi-map-marker</v-icon>
              <span>RIO ITATA 107, VILLA LAJA</span>
            </v-col>
          </v-row>
        </v-col>
        <v-col cols="12" sm="3" class="text-right">
         <!--xDD-->
        </v-col>
      </v-row>
      <v-row justify="center" no-gutters>
        <v-col class="text-center" cols="12">
          <v-divider class="my-4"></v-divider>
          <v-text>&copy; 2023 - {{ new Date().getFullYear() }} <strong>INSUMAR SPA. Todos los derechos reservados.</strong></v-text>
        </v-col>
      </v-row>
    </v-container>
  </v-footer>
</template>
