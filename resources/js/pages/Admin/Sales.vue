<template>
    <v-toolbar color="transparent" title="Venta">
      <v-spacer></v-spacer>

      <AdminDialogAddSales/>
    </v-toolbar>
    <div class="row d-flex justify-end">
    <v-col cols="12" md="3">
      <v-text-field
        label="Buscar venta"
        hint="Busca la venta por ID o por el nombre el vendedor"
        v-model="text"
        hide-details="auto"
        @click:append-inner="handleInput"
      ></v-text-field>
      </v-col>
    </div>
    <div class="table-responsive">
                 <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">Codigo de Venta</th>
                        <th scope="col">Fecha de Venta</th>
                        <th scope="col">Cliente</th>
                        <th scope="col">Monto Total</th>
                        <th scope="col">Vendido Por</th>
                        <th scope="col">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(sale, i) in paginatedSales" :key="i">
                        <th>{{ sale.codeSale }}</th>
                        <td>{{ moment(sale.created_at).format('LL') }}</td>
                        <td>{{ sale.name_client  }} {{ sale.last_client }}</td>
                        <td>{{ sale.total_pay.toLocaleString('es-CL')  }}</td>
                        <td>{{ sale.first_name }} {{ sale.last_name }}</td>
                        <td>
                          <v-btn icon="mdi-eye" size="x-small" color="success"></v-btn>
                          <v-btn class="ml-2" icon="mdi-printer" size="x-small" color="warning"></v-btn>
                          <v-btn class="ml-2" icon="mdi-delete" size="x-small" color="red" @click="deleteSale(sale.id)"></v-btn>
                        </td>
                      </tr>
                    </tbody>
                  </table>
       </div>
       <v-col cols="12">
          <v-pagination prev-icon="mdi-menu-left" next-icon="mdi-menu-right" v-model="current" :length="totalPages"></v-pagination>
       </v-col>
</template>
<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'
import Swal from 'sweetalert2'
import { rules } from '../../utils/input'
import moment from 'moment/moment';
import 'moment/locale/es';


const arraySales = ref([])
const text = ref('')

const current = ref(1) // Página actual, inicialmente establecida en 1
const pageSize = 8 // Tamaño de página deseado


function getSales() {
  moment.updateLocale('es', { invalidDate: 'No aplica' })
  axios.get('/getSales').then((response) => {
    arraySales.value = response.data

  })
}


function handleInput(newText) {
    text.value = newText; // Actualizar el valor de búsqueda en el componente padre
    
}


const paginatedSales = computed(() => {
  const startIndex = (current.value - 1) * pageSize;
  const endIndex = startIndex + pageSize;

  const regex = new RegExp(text.value, 'i'); // 'i' hace que la búsqueda sea insensible a mayúsculas y minúsculas

  var numeros = /\d+/g;

  if (Array.isArray(arraySales.value)) {
    let filteredSales = arraySales.value.slice();

    if (numeros.test(text.value)) {

      filteredSales = filteredSales.filter(sale => {
        // Convertimos sale.codeSale a cadena y comparamos con la expresión regular
        return sale.codeSale.toString().match(regex);
      });

    }else{
       filteredSales = filteredSales.filter(sale => {
        const nameComplete = `${sale.first_name} ${sale.last_name}` 
        return nameComplete.toString().match(regex);
      });
    }

    return filteredSales.slice(startIndex, endIndex);
  } else {
    return [];
  }
});


function deleteSale(id) {
    Swal.fire({
    title: "Estas seguro de eliminar esta venta?",
    html: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    cancelButtonText: "Cancelar",
    confirmButtonText: "Si, eliminar"
  }).then((result) => {
    if (result.isConfirmed) {
        axios.post('/eliminarVenta', { id: id })
        .then((response) => {
          Swal.fire({
            title: "Venta eliminada!",
            text: "La venta seleccionada ha sido eliminada exitosamente.",
            icon: "success"
          });

          getSales();
        })      
    }
  });
}

onMounted(() => {
  getSales()
})

// Propiedad computada para obtener el número total de páginas
const totalPages = computed(() => {
  const totalItems = arraySales.value.length // Utiliza arrayProductos.value.length en lugar de arrayProductos.length
  return Math.ceil(totalItems / pageSize)
})



</script>