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
                        <th scope="col">Precio producto</th>
                        <th scope="col">Fecha de Vencimiento</th>
                        <th scope="col">Mostrar Producto</th>
                        <th scope="col">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      <tr v-for="(data, i) in paginatedProductos">
                        <th scope="row">{{ data.id }}</th>
                        <td><v-img :src="data.image" :width="90"></v-img></td>
                        <td>{{data.name}}</td>
                        <td>{{data.price.toLocaleString('es-CL') }}</td>
                        <td>{{moment(data.expiration_date).format('LL')}}</td>
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
                        <td>
                            <v-btn icon="mdi-file" color="primary" size="x-small" @click="openDetails(data)"></v-btn>
                            <v-btn icon="mdi-pencil" class="ml-1" color="warning"  size="x-small" @click="openDialog(data)" />
                            <v-btn icon="mdi-delete" class="ml-1" color="red" size="x-small"  @click="eliminarProductos(data)" />
                        </td>
                      </tr>
                    </tbody>
                  </table>

                  <v-col cols="12">
                    <v-pagination prev-icon="mdi-menu-left" next-icon="mdi-menu-right" v-model="current" :length="totalPages"></v-pagination>
                  </v-col>

                <v-dialog
                    v-model="details"
                    width="auto"
                >
                <v-card
                  color="#114b86" 
                  class="pa-5"
                >
                  <v-card-title style="color: white;">Nombre del producto: {{ modelForm.name }}</v-card-title>
                    <v-list
                      :lines="false"
                      density="compact"
                      nav
                      style="background: transparent; color: white;"
                    >
                      <v-list-item
                        color="primary"
                        value="1"
                        :title="`Envase: ${modelForm.container}`"
                      >
                          <template v-slot:prepend>
                              <v-icon icon="mdi-semantic-web"></v-icon>
                          </template>
                      </v-list-item>

                      <v-list-item
                        color="primary"
                        value="2"
                        :title="`Cantidad disponible: ${modelForm.stock}`"
                      >
                          <template v-slot:prepend>
                              <v-icon icon="mdi-stocking"></v-icon>
                          </template>
                      </v-list-item>

                      <v-list-item
                        color="primary"
                        value="3"
                        :title="`Proveedor: ${modelForm.selectedProv}`"
                      >
                          <template v-slot:prepend>
                              <v-icon icon="mdi-account-group"></v-icon>
                          </template>
                      </v-list-item>

                      <v-list-item
                        color="primary"
                        value="4"
                        :title="`Precio: ${modelForm.price}`"
                      >
                          <template v-slot:prepend>
                              <v-icon icon="mdi-currency-usd"></v-icon>
                          </template>
                      </v-list-item>

                      <v-list-item
                        color="primary"
                        value="5"
                        :title="`Descripcion: ${modelForm.description}`"
                      >
                          <template v-slot:prepend>
                              <v-icon icon="mdi-text-box"></v-icon>
                          </template>
                      </v-list-item>

                      <v-list-item
                        color="primary"
                        value="5"
                        :title="`Fecha vencimiento: ${moment(modelForm.selectedDate).format('LL')}`"
                      >
                          <template v-slot:prepend>
                              <v-icon icon="mdi-calendar-range"></v-icon>
                          </template>
                      </v-list-item>


                  </v-list>
                  <v-card-actions>
                        <v-spacer></v-spacer>
                        <v-btn
                          color="red"
                          variant="text"
                          @click="details = false"
                        >
                          Cerrar
                        </v-btn>
                      </v-card-actions>
                </v-card>
                </v-dialog>

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
                              :items="['Caja', 'Saco']"
                              :rules="[rules.required]"
                            ></v-select>
                            </v-col>
                            <v-col cols="12" md="4">
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
                                :rules="[rules.required]"
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
    import moment from 'moment';
    import 'moment/locale/es';

    const current = ref(1) // Página actual, inicialmente establecida en 1
    const pageSize = 10 // Tamaño de página deseado

    const arrayProductos = ref([])
    const dialog = ref(false)
    const details = ref(false)
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
       selectedDate: null,
    })

    function traerProductos() {
      moment.updateLocale('es', { invalidDate: 'No aplica' })
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
            axios.post('/eliminarProductos', { id: data.id }).then(function response(){
              Swal.fire(
              'Eliminado !',
              'El producto ha sido eliminado.',
              'success'
            )
              traerProductos()
            }).catch(function (error) {
              Swal.fire(
                'Error !',
                'El producto no puede ser eliminado ya que tiene cajas registradas.',
                'error'
              )
            }) 
          }
      })
            
  }

  function actualizarProducto() {    

    // Obtener la fecha actual
    var today = new Date();
    // Establecer la fecha actual sin la parte de la hora, minutos, segundos y milisegundos
    today.setHours(0, 0, 0, 0);

    var selectedDate = new Date(modelForm.value.selectedDate);


    const formData = new FormData();
    formData.append('id', modelForm.value.id); // Asegúrate de incluir el ID del producto
    formData.append('name', modelForm.value.name);
    formData.append('description', modelForm.value.description);
    formData.append('container', modelForm.value.container);
    formData.append('stock', modelForm.value.stock);
    formData.append('price', modelForm.value.price);
    formData.append('id_supplier', modelForm.value.selectedProv);
    formData.append('fecha_vencimiento', modelForm.value.selectedDate);

    // Verifica si se ha seleccionado una nueva imagen
    if (modelForm.value.selectedFile[0]) {
      formData.append('imagen', modelForm.value.selectedFile[0]);
    }

    // verificamos la fecha de vencimiento
    if (selectedDate <= today) {
      Swal.fire({
        icon: 'info',
        title: 'Fecha de vencimiento incorrecta',
        text: 'No puedes agregar una fecha de vencimiento con fecha actual o anterior',
        showConfirmButton: true,
      })
        dialog.value = false
       
       return false
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
  modelForm.value.selectedDate = data.fecha_vencimiento
}

function openDetails(data) {

  const supplier = arraySuppliers.value.filter((supplier => supplier.id == data.id_supplier))
  

  details.value = true
  modelForm.value.id = data.id
  modelForm.value.name = data.name
  modelForm.value.description = data.description
  modelForm.value.stock = data.stock
  modelForm.value.container = data.container
  modelForm.value.price = data.price

  modelForm.value.selectedProv = supplier[0].contact_mail
  modelForm.value.selectedDate = data.fecha_vencimiento

 
}


</script>