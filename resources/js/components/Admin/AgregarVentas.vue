<template>
    <div class="text-center">
      <v-btn
        color="secondary" 
        variant="outlined"
      >
        Agregar Venta
  
        <v-dialog
          v-model="dialog"
          activator="parent"
          width="auto"
        >
          <v-card color="#114b86">
            <v-card-title class="text-h5">
              <span style="color: white;">Crear venta</span>
            </v-card-title>

            <v-sheet max-width="900" >
              <v-form style="background-color: #114b86fb; color:white" @submit.prevent="onCreate" class="pa-10">
                <v-row>
                  <v-col cols="12" md="8">
                    <v-select
                      v-model="selectedClient"
                      label="Selecciona al Cliente"
                      item-title="nombreApellido"
                      item-value="id"
                      :items="arrayClients"
                      :rules="[ rules.required ]"
                      required
                    >
                  </v-select>
                  </v-col>
                  <v-col cols="12">
                    <v-row v-for="(form, i) in arrayProductosAdd" :key="i">
                      <v-col cols="12" md="4">
                        <v-select
                          v-model="form.selectedProduct"
                          :hint="form.container"
                          item-title="name"
                          item-value="id"
                          label="Selecciona al Producto"
                          :items="arrayProductos"
                          @update:model-value="updateFields(i)"
                          :rules="[ rules.required ]"
                          required
                        >
                        </v-select>
                      </v-col>
                      <v-col cols="12" md="3">
                        <v-text-field label="Cantidad" required :rules="[ rules.required ]"  v-model="form.quantity" maxLength="4" :suffix="`/${form.stock_limited}`"></v-text-field>
                      </v-col>
                      <v-col cols="12" md="3">
                        <v-text-field disabled  prefix="$" label="Precio" v-if="form.price != null" :model-value="form.price.toLocaleString('es-CL')"></v-text-field>
                      </v-col>
                      <v-col cols="12" md="2">
                        <v-btn icon="mdi-plus" size="x-small" class="mr-1" color="primary" @click="duplicateForm()"></v-btn>
                        <v-btn v-if="arrayProductosAdd.length > 1" icon="mdi-minus" size="x-small" color="danger" @click="quitForm(i)"></v-btn>
                      </v-col>
                    </v-row>
                    Pago Total: <span>
                      <v-badge inline color="lime" :content="total">
                      </v-badge>
                    </span>
                  </v-col>
                </v-row>
                <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn
                  color="red"
                  variant="text"
                  @click="dialog = false"
                >
                  Cerrar
                </v-btn>
                <v-btn
                  color="green-darken-1"
                  variant="flat"
                  type="submit"
                  :loading="loading"
                >
                  Agregar
                </v-btn>
              </v-card-actions>
              </v-form>
            </v-sheet>
          </v-card>
        </v-dialog>
      </v-btn>
    </div>
</template>
<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'
import Swal from 'sweetalert2'
import { rules } from '../../utils/input'

const loading = ref(false)
const dialog = ref(false)

const arrayProductos = ref([])
const arrayClients = ref([])

const PagoTotalX = ref(null)

const selectedClient = ref(null)

const userData = ref({})

const arrayProductosAdd = ref([ { } ])


onMounted(() => {
   traerProductos()
   getClients()

   axios.get('/admin/GetUser')
          .then((response) => {
            userData.value = response.data                               
   })
})

function traerProductos() {
      axios.get('/admin/GetProductos')
          .then((response) => {
              arrayProductos.value = response.data
        })
    }

function getClients() {
  axios.get('/admin/GetClients').then((response) => {
     arrayClients.value = response.data.map(client => {
       return {
         ...client,
         nombreApellido: `${client.first_name} ${client.last_name}`,
       }
     })
  })
}

function updateFields(index) {
     
      const selectedProduct = arrayProductos.value.find(producto => producto.id === arrayProductosAdd.value[index].selectedProduct);      
      
      if (selectedProduct) {

        arrayProductosAdd.value[index].container = selectedProduct.container;
        arrayProductosAdd.value[index].price = selectedProduct.price;
        arrayProductosAdd.value[index].stock_limited = selectedProduct.stock
        
      }
}

function duplicateForm() {
  const newForm = {
    selectedProduct: null,
    quantity: null,
    stock_limited: 0,
    container: null,
    price: null,
    // ... otras propiedades que necesites inicializar
  };
  arrayProductosAdd.value.push(newForm);
}

function quitForm(i) {
  arrayProductosAdd.value.splice(i, 1);
}

// Crea una propiedad computada para calcular el total
const total = computed(() => {
  let totalAmount = 0;

  for (const form of arrayProductosAdd.value) {
    const selectedProduct = arrayProductos.value.find(producto => producto.id === form.selectedProduct);
    if (selectedProduct && form.quantity) {
      totalAmount += selectedProduct.price * form.quantity;
    }
  }

  return totalAmount.toLocaleString('es-CL');
});


function onCreate() {
 
  const data = ref({
    'id_client': selectedClient.value, 
    'id_employee': userData.value.id, 
    'productos': arrayProductosAdd.value 
  })

  if (!selectedClient.value) {
     return true;
  }
  
  if (arrayProductosAdd.value.some(function(product) {
    return !product.selectedProduct || !product.quantity;
  })) {
      return true;
  }

      loading.value = true

      axios.post('/crearVenta', data.value)
      .then((response) => {
          Swal.fire({
          position: "top-end",
          title: "Venta creada",
          text: "La venta ha sido creada exitosamente.",
          icon: "success",
          showConfirmButton: false,
          timer: 1500
        });     
        
        loading.value = false
        dialog.value = false
        window.location.reload()
      }).catch(function (error) {
          Swal.fire({
            position: "top-end",
            title: "Error al crear la venta",
            text:  'Uno de los productos que añadiste tiene stock insuficiente',
            icon: "error",
            showConfirmButton: false,
            timer: 1500
          })

          loading.value = false
      }) 

  
}
</script>