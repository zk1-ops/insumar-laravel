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
        <v-card-title style="color: white;">Creando un nuevo producto</v-card-title>
        <v-form  style="color: white;" @submit.prevent="onCreate">
          <v-container>
            <v-row>
              <v-col
                cols="12"
                md="6"
              >
                <v-text-field
                  v-model="modelForm.name"
                  variant="outlined"
                  prepend-inner-icon="mdi-shopping"
                  :counter="10"
                  label="Nombre Producto"
                  required
                  hide-details
                  :rules="[rules.required]"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                md="6"
              >
              <v-select
                variant="outlined"
                v-model="modelForm.container"
                label="Escoge el envase del producto"
                prepend-inner-icon="mdi-semantic-web"
                :items="['Bandeja', 'Saco']"
                :rules="[rules.required]"
              ></v-select>
              </v-col>
              <v-col cols="12" md="3">
              <v-text-field
                v-model="modelForm.stock"
                variant="outlined"
                prepend-inner-icon="mdi-stocking"
                label="Stock"
                :rules="[rules.required, rules.isNumber]"
              >
            </v-text-field>
            </v-col>
              <v-col cols="12" md="4">
                <v-select
                  variant="outlined"
                  v-model="modelForm.selectedProv"
                  prepend-inner-icon="mdi-account-group"
                  :items="arraySuppliers"
                  item-title="business_name"
                  item-value="id"
                  label="Proveedor"
                  :rules="[rules.required]"
                  persistent-hint
                >
                  <template v-slot:item="{ props, item }">
                    <v-list-item v-bind="props" :subtitle="item.raw.contact_mail"></v-list-item>
                  </template>
                </v-select>
              </v-col>
              <v-col
                cols="12"
                md="4"
              >
                <v-text-field
                  v-model="modelForm.price"
                  variant="outlined"
                  prepend-inner-icon="mdi-currency-usd"
                  label="Costo del producto"
                  hide-details
                  required
                  :rules="[rules.required]"
                ></v-text-field>
              </v-col>
              <v-col
                cols="12"
                md="12"
              >
              <v-textarea prepend-inner-icon="mdi-text-box" variant="outlined" :counter="150" :rules="[rules.required, rules.maxLength(150)]" v-model="modelForm.description" label="Descripcion del producto"></v-textarea>
              </v-col>
              <v-col
                cols="12"
                md="4"
              > 
                  <v-text-field :rules="[rules.required]" v-model="modelForm.selectedDate" type="date" label="Date"></v-text-field>
              </v-col>
              <v-col cols="12" md="6">
                <v-file-input  :rules="[rules.required]" label="Subir Imagen Producto" ref="fileInput" v-model="modelForm.selectedFile" accept="image/*" variant="outlined"></v-file-input>
              </v-col>
            
            </v-row>
          </v-container>
          <v-card-actions>
            <v-btn color="red" @click="dialogAddProd = false">Cerrar</v-btn>
            <v-btn variant="tonal" type="submit" color="success">Crear</v-btn>
        </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script setup lang="ts">
import { ref, onMounted, watch } from 'vue'
import axios from 'axios'
import { rules } from '../../utils/input'
import Swal from 'sweetalert2'


const dialogAddProd = ref(false)
const modelForm = ref({
  name: '',
  description: '',
  container: 'Selecciona el tipo',
  stock: null,
  price: null,
  selectedFile: [],
  selectedProv: null,
  selectedDate: null
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
  if( !modelForm.value.name ||
    !modelForm.value.description ||
    !modelForm.value.container ||
    !modelForm.value.stock || 
    !modelForm.value.price || 
    !modelForm.value.selectedFile || 
    !modelForm.value.selectedProv || !modelForm.value.selectedDate) 
    {  return false; }

  const formData = new FormData();
  formData.append('nombre', modelForm.value.name);
  formData.append('description', modelForm.value.description);
  formData.append('container', modelForm.value.container);
  formData.append('stock', modelForm.value.stock);
  formData.append('price', modelForm.value.price);
  formData.append('imagen', modelForm.value.selectedFile[0]);
  formData.append('id_supplier', modelForm.value.selectedProv);
  formData.append('fecha_vencimiento', modelForm.value.selectedDate);


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