<template>
    <v-row justify="center">
    <v-dialog
      v-model="dialogAddProd"
      persistent
      width="auto"
    >
      <template v-slot:activator="{ props }">
        <v-btn
          v-bind="props"
          color="secondary" variant="outlined"
          >
          Agregar productos
        </v-btn>
      </template>
      <v-card color="#114b86">
        <v-card-title class="text-h5">
          Agregar Producto
        </v-card-title>
        
          <v-sheet max-width="400" >
            <v-form style="background-color: #114b86; color:white" @submit.prevent="onCreate" class="pa-10">
              <v-row>
                <v-col cols="12" >
                  <v-text-field
                  v-model="modelForm.nombre"
                  variant="outlined"
                  label="Nombre"></v-text-field>
                </v-col>
                <v-col cols="12" >
                  <v-text-field
                  v-model="modelForm.descripcion"
                  variant="outlined"
                  label="Descripcion"></v-text-field>
                </v-col>
                <v-col cols="12" >
                  <v-text-field
                  v-model="modelForm.envase"
                  variant="outlined"
                  label="Envase"></v-text-field>
                </v-col>
                <v-col cols="12" >
                  <v-text-field
                  v-model="modelForm.precio"
                  variant="outlined"
                  label="Precio"></v-text-field>
                </v-col>
              </v-row>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="green-darken-1"
                  variant="text"
                  @click="dialogAddProd = false"
                >
                  Disagree
                </v-btn>
                <v-btn
                  color="green-darken-1"
                  variant="text"
                  type="submit"
                >
                  Agree
                </v-btn>
              </v-card-actions>
            </v-form>
          </v-sheet>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios'

function onCreate() {
  axios.post('/agregarProducto', modelForm.value)
}

const dialogAddProd = ref(false)
const loading = ref(false)  
const userName = ref('')
const modelForm = ref({
  nombre:'',
  descripcion:'',
  envase:'',
  precio:null,
})

</script>