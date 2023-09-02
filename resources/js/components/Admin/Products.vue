<template>
    <h1>Vista Productos!</h1>
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
                            <v-btn color="red" @click="eliminarProductos(data.id)">eliminar</v-btn>
                            <v-btn color="warning" @click="editarProducto(data)">editar</v-btn>
                        </td>
                      </tr>
                    
                    </tbody>
                  </table>
              </div>
  </template>

<script setup lang="ts">
    import { ref, onMounted } from 'vue'
    import axios from 'axios'

    const arrayProductos = ref([])


    onMounted(() => {
    axios.get('/GetProduct')
    .then((response) => {
        arrayProductos.value = response.data 

  })    

})
function eliminarProductos(id){
        axios.post('/eliminarProductos', id)
        window.location.reload()
        
  }
function editarProducto(id){
        axios.post('/editarProductos', id)

}
</script>