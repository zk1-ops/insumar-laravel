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
                        <th scope="col">Nombre</th>
                        <th scope="col">Envase</th>
                        <th scope="col">Total_pay</th>
                        <th scope="col">Acción</th>
                      </tr>
                    </thead>
                    <tbody>
                    
                      <tr v-for="(data, i) in arrayProductos">
                        <th scope="row">{{ data.id }}</th>
                        <td>{{data.nombre}}</td>
                        <td>{{data.envase}}</td>
                        <td>{{data.total_pay }}</td>
                        <td>
                            <v-btn icon="mdi-delete" class="mr-1" color="red" @click="eliminarProductos(data)" />
                            <v-btn icon="mdi-pencil" color="warning" @click="openDialog(data)" />
                        </td>
                      </tr>
                    </tbody>
                  </table>

                <v-dialog
                    v-model="dialog"
                    width="auto"
                  >
                    <v-card color="#114b86">
                      <v-card-title>Modificando el producto ({{ modelForm.nombre }})</v-card-title>
                      <v-form v-model="valid">
                        <v-container>
                          <v-row>
                            <v-col
                              cols="12"
                              md="12"
                            >
                              <v-text-field
                                v-model="modelForm.nombre"
                                :counter="10"
                                label="Nombre Producto"
                                required
                                hide-details
                              ></v-text-field>
                            </v-col>

                            <v-col
                              cols="12"
                              md="12"
                            >
                              <v-text-field
                                v-model="modelForm.envase"
                                label="Envase del producto"
                                hide-details
                                required
                              ></v-text-field>
                            </v-col>
                            <v-col
                              cols="12"
                              md="12"
                            >
                              <v-text-field
                                v-model="modelForm.total_pay"
                                label="Costo del producto"
                                hide-details
                                required
                              ></v-text-field>
                            </v-col>
                            <v-col
                              cols="12"
                              md="12"
                            >
                            <v-textarea v-model="modelForm.descripcion" label="Descripcion del producto"></v-textarea>
                            </v-col>
                          </v-row>
                        </v-container>
                      </v-form>
                      <v-card-actions>
                        <v-btn color="red" @click="dialog = false">Cerrar</v-btn>
                        <v-btn variant="tonal" @click="actualizarProducto" color="success">Actualizar</v-btn>
                      </v-card-actions>
                    </v-card>
                </v-dialog>
        </div>
  </template>

<script setup lang="ts">
    import { ref, onMounted } from 'vue'
    import axios from 'axios'
    import Swal from 'sweetalert2'

    const dialogAddProd = ref(false)

    const arrayProductos = ref([])
    const dialog = ref(false)
    const valid = ref('')

    const modelForm = ref({
       id: null,
       nombre: '',
       descripcion: '',
       envase: '',
       total_pay: ''
    })

    function traerProductos() {
      axios.get('/admin/GetProductos')
          .then((response) => {
              arrayProductos.value = response.data 
        })
    }
    onMounted(() => {
       traerProductos()
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
    axios.post('/actualizarProductos', modelForm.value).then(function response() {
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

function openDialog(data) {
  dialog.value = true
  modelForm.value.id = data.id
  modelForm.value.nombre = data.nombre
  modelForm.value.descripcion = data.descripcion
  modelForm.value.envase = data.envase
  modelForm.value.total_pay = data.total_pay
}
</script>