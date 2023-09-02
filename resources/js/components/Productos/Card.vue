<template>
  <v-container v-if="loading" class="d-flex justify-center">
    <v-progress-circular
      :size="50"
      color="primary"
      indeterminate
    ></v-progress-circular>
  </v-container>
  <v-container v-else fluid>
    <v-row class="text-center" v-if="arrayProductos.length != 0">
      <v-col
        class="card-effect-zoom"
        cols="12"
        md="4"
        lg="3"
        v-for="(item, index) in arrayProductos"
        :key="index"
      >
        <v-card  style="background: rgba(20, 77, 131, 0.637);" variant="outlined" max-width="250" class="mx-auto" >
          <v-chip class="ma-2" style="left: 35%; background-color: rgb(4, 219, 137);" label>
            <v-icon start icon="mdi-currency-usd"></v-icon>
            {{ item.total_pay }}
          </v-chip>

          <v-img :src="item.image" height="200" contain class="align-self-center" />
          <v-card-title class="text-center text-white">{{ item.nombre }}</v-card-title>
          <v-card-actions class="text-center">
            <v-btn
              color="primary"
              variant="outlined"
              class="mx-auto"
              text
              rounded
              @click="showDetails(index)"
            >
              Detalles
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>
    </v-row>
    <div v-else class="d-flex justify-center">
      <v-alert
        type="error"
        text="No se encontraron productos"
    ></v-alert>
    </div>

    <v-dialog v-model="dialog" max-width="500">
      <v-card max-width="350" class="mx-auto rounded-xl">
        <br>
        <v-img :src="selectedProduct.image" height="250" />
        <v-card-title class="text-center">{{ selectedProduct.nombre }}</v-card-title>
        <v-card-subtitle class="text-center">Tipo de envase: {{ selectedProduct.envase }}</v-card-subtitle>
        <v-card-text class="text-center">{{ selectedProduct.descripcion }}</v-card-text>
        
        <v-card-actions>
          <v-btn  class="mx-auto" variant="tonal" color="primary" text @click="dialog = false">Cerrar</v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-container>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'

const arrayProductos = ref([])
const maxProductsToShow = 4 // Cambia este valor al máximo deseado

const loading = ref(true)


onMounted(() => {
  axios.get('/GetProduct')
  .then((response) => {
     arrayProductos.value = response.data 
     loading.value = false

     arrayProductos.value.sort((a, b) => new Date(b.created_at) - new Date(a.created_at));
     arrayProductos.value.splice(maxProductsToShow);
       
  })
})

const dialog = ref(false)
const selectedProduct = ref({})

function showDetails(index) {
  selectedProduct.value = arrayProductos.value[index]
  dialog.value = true
}

</script>
