<template>
  <SectionSeparator class="title" title="Nuestros productos" subtitle="Accede a todos nuestros productos" />
  <div class="row d-flex justify-end">
    <v-col cols="12" md="3">
      <v-text-field
      label="Buscar producto"
      v-model="text"
      hide-details="auto"
      append-inner-icon="mdi-magnify"
      @click:append-inner="handleInput"
    ></v-text-field>
    </v-col>
  </div>
  <v-container v-if="loading" class="d-flex justify-center">
    <v-progress-circular
      :size="50"
      color="primary"
      indeterminate
    ></v-progress-circular>
  </v-container>
    <v-container v-else fluid>
      <v-row class="text-center" v-if="paginatedProductos.length != 0">
        <v-col
          class="card-effect-zoom"
          cols="12"
          md="4"
          lg="3"
          v-for="(item, index) in paginatedProductos"
          :key="index"
        >
          <v-card  style="background: rgba(20, 77, 131, 0.637);" variant="outlined" max-width="250" class="mx-auto" >
            <v-chip class="ma-2" style="left: 35%; background-color: rgb(4, 219, 137);" label>
              <v-icon start icon="mdi-currency-usd"></v-icon>
              {{ item.price.toLocaleString('es-CL') }}
            </v-chip>
  
            <v-img :src="item.image" height="200" contain class="align-self-center" />
            <v-card-title class="text-center text-white">{{ item.name }}</v-card-title>
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
        <v-col cols="12">
          <v-pagination prev-icon="mdi-menu-left" next-icon="mdi-menu-right" v-model="current" :length="totalPages"></v-pagination>
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
          <v-card-title class="text-center">{{ selectedProduct.name }}</v-card-title>
          <v-card-subtitle class="text-center">Tipo de envase: {{ selectedProduct.envase }}</v-card-subtitle>
          <v-card-text class="text-center">{{ selectedProduct.description }}</v-card-text>
          
          <v-card-actions>
            <v-btn  class="mx-auto" variant="tonal" color="primary" text @click="dialog = false">Cerrar</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-container>
  </template>
  
  <script setup lang="ts">
  import { ref, onMounted, computed } from 'vue'
  import axios from 'axios'
  
  const arrayProductos = ref([])
  const loading = ref(true)
  const text = ref('')

  const current = ref(1) // Página actual, inicialmente establecida en 1
  const pageSize = 8 // Tamaño de página deseado


  function handleInput(newText) {
    text.value = newText; // Actualizar el valor de búsqueda en el componente padre
    console.log(newText);
    
  }

  onMounted(() => {
    axios.get('/GetProduct')
    .then((response) => {
      arrayProductos.value = response.data.filter(item => item.show_product === 1); 
       loading.value = false
    })
  })
  
  const dialog = ref(false)
  const selectedProduct = ref({})
  
  function showDetails(index) {
    selectedProduct.value = arrayProductos.value[index]
    dialog.value = true
  }

  const paginatedProductos = computed(() => {
    const startIndex = (current.value - 1) * pageSize;
    const endIndex = startIndex + pageSize

    if (Array.isArray(arrayProductos.value)) {
      let filtredProductos = arrayProductos.value.slice();

      // aplicamos el filtro por nombre

      filtredProductos = filtredProductos.filter(producto => 
        producto.name.toLowerCase().match(text.value.toLowerCase())
      )

      return filtredProductos.slice(startIndex, endIndex)
    } else{
      return []
    }
  })

// Propiedad computada para obtener el número total de páginas
const totalPages = computed(() => {
  const totalItems = arrayProductos.value.length // Utiliza arrayProductos.value.length en lugar de arrayProductos.length
  return Math.ceil(totalItems / pageSize)
})

  
  </script>
  