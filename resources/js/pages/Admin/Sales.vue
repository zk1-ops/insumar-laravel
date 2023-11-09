<template>
    <v-toolbar color="transparent" title="Venta">
      <v-spacer></v-spacer>

      <AdminDialogAddSales/>
    </v-toolbar>
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
                      <tr v-for="(sale, i) in arraySales" :key="i">
                        <th>{{ sale.codeSale }}</th>
                        <td>{{  moment().format('LLLL') }}</td>
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
</template>
<script setup lang="ts">
import { ref, onMounted, computed } from 'vue'
import axios from 'axios'
import Swal from 'sweetalert2'
import { rules } from '../../utils/input'
import moment from 'moment/moment';
import 'moment/locale/es';


const arraySales = ref([])

function getSales() {
  moment.updateLocale('es', { invalidDate: 'No aplica' })
  axios.get('/getSales').then((response) => {
    arraySales.value = response.data

  })
}


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


</script>