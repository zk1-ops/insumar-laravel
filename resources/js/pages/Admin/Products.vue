<template>
    <v-toolbar color="transparent" title="Productos">
      <v-spacer></v-spacer>

      <AdminDialogAddProductos />
    </v-toolbar> <br>
    <div class="table-responsive">
                 <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col"></th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Envase</th>
                        <th scope="col">Precio producto</th>
                        <th scope="col">Mostrar Producto</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      <tr v-for="(data, i) in paginatedProductos">
                        <th scope="row">{{ data.id }}</th>
                        <td><v-img :src="data.image" :width="90"></v-img></td>
                        <td>{{data.name}}</td>
                        <td>
                          <v-textarea 
                          disabled
                          rows="1"
                          row-height="15" 
                          variant="filled" 
                          auto-grow 
                          bg-color="amber-lighten-4"
                          :model-value="data.description">
                        </v-textarea>
                      </td>
                        <td>{{data.container}}</td>
                        <td>{{data.price.toLocaleString('es-CL') }}</td>
                        <td>
                          <v-switch
                            v-model="data.show_product"
                            :true-value="1"
                            color="primary"
                            :false-value="0"
                            hide-details
                            @change.stop="guardarDatos(data.id, data.show_product)"
                          ></v-switch>
                        </td>
                        <td>{{  data.stock  }}</td>
                        <td>
                            <v-btn icon="mdi-delete" class="mr-1" color="red" @click="eliminarProductos(data)" />
                            <v-btn icon="mdi-pencil" color="warning" @click="openDialog(data)" />
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <v-col cols="12">
                    <v-pagination prev-icon="mdi-menu-left" next-icon="mdi-menu-right" v-model="current" :length="totalPages"></v-pagination>
                  </v-col>

                <v-dialog
                    v-model="dialog"
                    width="auto"
                  >
                    <v-card color="#114b86">
                      <v-card-title style="color: white;">Modificando el producto ({{ modelForm.name }})</v-card-title>
                      <v-form style="color: white;" v-model="valid" @submit.prevent="actualizarProducto()">
                        <v-container>
                          <v-row>
                            <v-col
                              cols="12"
                              md="12"
                            >
                              <v-text-field
                                variant="outlined"
                                v-model="modelForm.name"
                                :counter="10"
                                label="Nombre Producto"
                                required
                                hide-details
                                :rules="[rules.required]"
                              ></v-text-field>
                            </v-col>

                            <v-col
                              cols="12"
                              md="12"
                            >
                              <v-text-field
                                v-model="modelForm.container"
                                variant="outlined"
                                label="Envase del producto"
                                hide-details
                                required
                                :rules="[rules.required]"
                              ></v-text-field>
                            </v-col>
                            <v-col cols="12" >
                            <v-text-field
                              v-model="modelForm.stock"
                              variant="outlined"
                              label="Stock"
                              :rules="[rules.required, rules.isNumber]"
                            >
                          </v-text-field>
                          </v-col>
                            <v-col cols="12" md="12">
                              <v-select
                                variant="outlined"
                                v-model="modelForm.selectedProv"
                                :items="arraySuppliers"
                                item-title="business_name"
                                item-value="id"
                                label="Proveedor"
                                persistent-hint
                              >
                                <template v-slot:item="{ props, item }">
                                  <v-list-item v-bind="props" :subtitle="item.raw.contact_mail"></v-list-item>
                                </template>
                              </v-select>
                            </v-col>
                            <v-col
                              cols="12"
                              md="12"
                            >
                              <v-text-field
                                v-model="modelForm.price"
                                variant="outlined"
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
                            <v-textarea variant="outlined" :counter="150" :rules="[rules.required, rules.maxLength(150)]" v-model="modelForm.description" label="Descripcion del producto"></v-textarea>
                            </v-col>
                            <v-col cols="12">
                              <v-file-input  :rules="[rules.required]" label="Subir Imagen Producto" ref="fileInput" v-model="modelForm.selectedFile" accept="image/*" variant="outlined"></v-file-input>
                            </v-col>
                          </v-row>
                        </v-container>
                        <v-card-actions>
                          <v-btn color="red" @click="dialog = false">Cerrar</v-btn>
                          <v-btn variant="tonal" type="submit" color="success">Actualizar</v-btn>
                      </v-card-actions>
                      </v-form>
                    </v-card>
                </v-dialog>
        </div>
  </template>

<script setup lang="ts">
    import { ref, onMounted, computed } from 'vue'
    import axios from 'axios'
    import Swal from 'sweetalert2'
    import { rules } from '../../utils/input'

    const current = ref(1) // Página actual, inicialmente establecida en 1
    const pageSize = 10 // Tamaño de página deseado

    const arrayProductos = ref([])
    const dialog = ref(false)
    const valid = ref('')

    const arraySuppliers = ref([])
    
    const modelForm = ref({
       id: null,
       name: '',
       description: '',
       container: '',
       stock: '',
       price: '',
       selectedFile: [],
       selectedProv: null,
    })

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

    // Propiedad computada para obtener el número total de páginas
    const totalPages = computed(() => {
      const totalItems = arrayProductos.value.length // Utiliza arrayProductos.value.length en lugar de arrayProductos.length
      return Math.ceil(totalItems / pageSize)
    })

    const paginatedProductos = computed(() => {
      const startIndex = (current.value - 1) * pageSize;
      const endIndex = startIndex + pageSize

      if (Array.isArray(arrayProductos.value)) {
        let filtredProductos = arrayProductos.value.slice();

        return filtredProductos.slice(startIndex, endIndex)
    } else{
      return []
    }
  })
    onMounted(() => {
       traerProductos()
       getSupplier()
    })
    function eliminarProductos(data){
      Swal.fire({
          title: 'Estas seguro de eliminar este producto?',
          text: "No se puede revertir!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, estoy seguro!'
        }).then((result) => {
          if (result.isConfirmed) {
            Swal.fire(
              'Eliminado !',
              'El producto ha sido eliminado.',
              'success'
            )
            axios.post('/eliminarProductos', { id: data.id }).then(function response(){
              traerProductos()
            })  
          }
      })
            
  }

  function actualizarProducto() {    

    const formData = new FormData();
    formData.append('id', modelForm.value.id); // Asegúrate de incluir el ID del producto
    formData.append('name', modelForm.value.name);
    formData.append('description', modelForm.value.description);
    formData.append('container', modelForm.value.container);
    formData.append('stock', modelForm.value.stock);
    formData.append('price', modelForm.value.price);
    formData.append('id_supplier', modelForm.value.selectedProv);
    
    // Verifica si se ha seleccionado una nueva imagen
    if (modelForm.value.selectedFile[0]) {
      formData.append('imagen', modelForm.value.selectedFile[0]);
    }

    
    axios.post('/actualizarProductos', formData, {
      headers: {
        'Content-Type': 'multipart/form-data' // Configura el tipo de contenido para cargar archivos
      }
    }).then(function response() {
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Ha sido actualizado correctamente',
        showConfirmButton: false,
        timer: 1500
      })
        traerProductos()
        dialog.value = false
    })
  }

async function guardarDatos(id,status) {
  try {
     // Enviar datos a la base de datos usando una solicitud POST o PUT
     await axios.post("/admin/product/SaveStatus", {
        id,
        status
    });
     
  } catch (error) { 
    console.log(error);
  }
}
function openDialog(data) {
  dialog.value = true
  modelForm.value.id = data.id
  modelForm.value.name = data.name
  modelForm.value.description = data.description
  modelForm.value.stock = data.stock
  modelForm.value.container = data.container
  modelForm.value.price = data.price

  modelForm.value.selectedProv = data.id_supplier
}


</script>