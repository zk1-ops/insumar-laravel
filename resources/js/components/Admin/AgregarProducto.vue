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
          <span style="color: white;">Agregar Producto</span>
        </v-card-title>
        
          <v-sheet max-width="400" >
            <v-form  style="background-color: #114b86fb; color:white" @submit.prevent="onCreate" class="pa-10">
              <v-row>
                <v-col cols="12" >
                  <v-text-field
                    v-model="modelForm.name"
                    variant="outlined"
                    label="Nombre"
                    :rules="[rules.required]"
                  >
                </v-text-field>
                </v-col>
                <v-col cols="12" >
                  <v-text-field
                    v-model="modelForm.description"
                    variant="outlined"
                    label="Descripcion"
                    :rules="[rules.required]"
                  >
                  </v-text-field>
                </v-col>
                <v-col cols="12" >
                  <v-text-field
                    v-model="modelForm.container"
                    variant="outlined"
                    label="Envase"
                    :rules="[rules.required]"
                  >
                </v-text-field>
                </v-col>
                <v-col cols="12" >
                  <v-text-field
                    v-model="modelForm.stock"
                    variant="outlined"
                    label="Stock"
                    :rules="[rules.required]"
                  >
                </v-text-field>
                </v-col>
                <v-col cols="12" >
                  <v-text-field
                    v-model="modelForm.price"
                    variant="outlined"
                    label="Precio"
                    :rules="[rules.required]"
                  >
                </v-text-field>
                </v-col>
                <v-col cols="12">
                  <v-select
                    v-model="modelForm.selectedProv"
                    :items="arraySuppliers"
                    variant="outlined"
                    item-title="business_name"
                    item-value="id"
                    label="Default"
                    persistent-hint
                  >
                    <template v-slot:item="{ props, item }">
                      <v-list-item v-bind="props" :subtitle="item.raw.contact_mail"></v-list-item>
                    </template>
                  </v-select>
                </v-col>
                <v-col cols="12">
                  <v-file-input :rules="[rules.required]" label="Subir Imagen Producto" ref="fileInput" v-model="modelForm.selectedFile" accept="image/*" variant="outlined"></v-file-input>
                </v-col>
              </v-row>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="red"
                  variant="text"
                  @click="dialogAddProd = false"
                >
                  Cerrar
                </v-btn>
                <v-btn
                  color="green-darken-1"
                  variant="flat"
                  type="submit"
                >
                  Agregar
                </v-btn>
              </v-card-actions>
            </v-form>
          </v-sheet>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import { rules } from '../../utils/input'
import Swal from 'sweetalert2'


const dialogAddProd = ref(false)
const modelForm = ref({
  name: '',
  description: '',
  container: '',
  stock: null,
  price: null,
  selectedFile: [],
  selectedProv: null
})

const arrayProductos = ref([])
const arraySuppliers = ref([])

function traerProductos() {
      axios.get('/admin/GetProductos')
          .then((response) => {
              arrayProductos.value = response.data 
        })
    }

function getSupplier() {
  axios.get('/admin/GetSuppliers')
      .then((response) => {
        arraySuppliers.value = response.data 
        
    })
}

onMounted(async () => {
  await getSupplier()
})


function onCreate() {
  // Crea un objeto FormData y agrega el archivo seleccionado
  const formData = new FormData();
  formData.append('nombre', modelForm.value.name);
  formData.append('description', modelForm.value.description);
  formData.append('container', modelForm.value.container);
  formData.append('stock', modelForm.value.stock);
  formData.append('price', modelForm.value.price);
  formData.append('imagen', modelForm.value.selectedFile[0]);
  formData.append('id_supplier', modelForm.value.selectedProv);


 axios.post('/agregarProducto', formData, {
   headers: {
     'Content-Type': 'multipart/form-data' // Configura el tipo de contenido para cargar archivos
   }
 }).then((response) => {
   Swal.fire({
       position: 'top-end',
       icon: 'success',
       title: 'Ha sido agregado correctamente',
       showConfirmButton: false,
       timer: 1500
     })
       window.location.reload();
       dialogAddProd.value = false
 })
}
</script>