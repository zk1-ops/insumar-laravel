<template>
    <v-toolbar color="transparent" title="Proveedores">
      <v-spacer></v-spacer>

      <AdminDialogAddProveedores/>
    </v-toolbar>
    <div class="table-responsive">
                 <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre Empresa</th>
                        <th scope="col">Rut Empresa</th>
                        <th scope="col">Persona de Contacto</th>
                        <th scope="col">Email de Contacto</th>
                        <th scope="col">Telefono de Contacto</th>
                        <th scope="col">Ciudad</th>
                        <th scope="col">Direccion</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(supplier, i) in arraySuppliers" :key="i">
                        <th scope="row">{{ supplier.id }}</th>
                        <td>{{  supplier.business_name  }}</td>
                        <td>{{  supplier.dni }}</td>
                        <td>{{  supplier.contact_person }}</td>
                        <td>{{  supplier.contact_mail }}</td>
                        <td>{{  supplier.contact_phone }}</td>
                        <td>{{  supplier.city }}</td>
                        <td>{{  supplier.address }}</td>
                        <td>
                          <v-btn icon="mdi-pencil" size="x-small" color="warning" @click="openDialog(supplier)" />
                          <v-btn icon="mdi-delete" size="x-small" color="red" class="ml-1" @click="eliminarProveedor(supplier)"/>
                        </td>
                      </tr>
                    </tbody>
                  </table>
      </div>
      <v-dialog
         v-model="dialog"
         width="auto"          
      >
          <v-card color="#114b86" class="pa-5">
            <v-card-title style="color: white;">Modificando el proveedor ({{ modelForm.business_name }})</v-card-title>
            <v-sheet max-width="600" style="background-color: #114b86fb; color:white">
            <v-form @submit.prevent="actualizarProveedor">
              <v-row>
                <v-col cols="12" md="6" >
                  <v-text-field
                    v-model="modelForm.business_name"
                    prepend-inner-icon="mdi-google-my-business"
                    variant="outlined"
                    label="Nombre Empresa"
                    :rules="[rules.required]"
                  >
                </v-text-field>
                </v-col>
                <v-col cols="12" md="6" >
                  <v-text-field
                    v-model="modelForm.dni"
                    prepend-inner-icon="mdi-account-credit-card"
                    variant="outlined"
                    label="Rut Empresa"
                    :rules="[rules.required]"
                  >
                  </v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                  <v-text-field
                    v-model="modelForm.contact_person"
                    prepend-inner-icon="mdi-account"
                    variant="outlined"
                    label="Persona de Contacto"
                    :rules="[rules.required]"
                  >
                  </v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                  <v-text-field
                    v-model="modelForm.contact_mail"
                    prepend-inner-icon="mdi-email"
                    variant="outlined"
                    label="Email de Contacto"
                    :rules="[rules.required]"
                  >
                </v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                  <v-text-field
                    v-model="modelForm.contact_phone"
                    prepend-inner-icon="mdi-phone"
                    variant="outlined"
                    label="Telefono de contacto"
                    :rules="[rules.required]"
                  >
                </v-text-field>
                </v-col>
                <v-col cols="12" md="6">
                  <v-text-field
                    v-model="modelForm.city"
                    prepend-inner-icon="mdi-city"
                    variant="outlined"
                    label="Ciudad"
                    :rules="[rules.required]"
                  >
                </v-text-field>
                </v-col>
                <v-col cols="12" >
                  <v-text-field
                    v-model="modelForm.address"
                    prepend-inner-icon="mdi-map-marker"
                    variant="outlined"
                    label="Dirección"
                    :rules="[rules.required]"
                  >
                </v-text-field>
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
                  variant="tonal"
                  type="submit"
                >
                  Actualizar
                </v-btn>
              </v-card-actions>
            </v-form>
          </v-sheet>
          </v-card>
        </v-dialog>
</template>
<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios';
import Swal from 'sweetalert2';
import { rules } from '../../utils/input'

const arraySuppliers = ref([])

const dialog = ref(false)

const modelForm = ref({
  id: null,
  business_name: '',
  dni: '',
  contact_person: '',
  contact_mail: '',
  contact_phone: '',
  city: '',
  address: ''
})

function getSupplier() {
  axios.get('/admin/GetSuppliers')
      .then((response) => {
        arraySuppliers.value = response.data 
        
    })
}

onMounted(async () => {
  await getSupplier()
})

function eliminarProveedor(data){
      Swal.fire({
          title: 'Estas seguro de eliminar este proveedor?',
          html: `Estas eliminado a:<br><br> NOMBRE EMPRESA: ${data.business_name}<br>RUT EMPRESA: ${data.dni}<br> PERSONA CONTACTO: ${data.contact_person}<br><br> Esto No se puede revertir!`,
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          cancelButtonText: 'Cancelar',
          confirmButtonText: 'Si, estoy seguro!'
        }).then((result) => {
          if (result.isConfirmed) {
            axios.post('/eliminarProveedor', { id: data.id }).then(function response(){
              Swal.fire(
                'Eliminado !',
                'El proveedor ha sido eliminado.',
                'success'
              )
              getSupplier()
            }).catch(function (error) {
              Swal.fire(
                'Error !',
                'El proveedor no pudo ser eliminado ya que tiene productos registrados.',
                'error'
              )
            })
          }
      })
            
}

function openDialog(data) {
  dialog.value = true
  modelForm.value.id = data.id
  modelForm.value.business_name = data.business_name
  modelForm.value.dni = data.dni
  modelForm.value.contact_person = data.contact_person
  modelForm.value.contact_mail = data.contact_mail
  modelForm.value.contact_phone = data.contact_phone
  modelForm.value.city = data.city
  modelForm.value.address = data.address
}

function actualizarProveedor() { 
  axios.post('/actualizarProveedor', modelForm.value, {
    
    }).then(function response() {
      Swal.fire({
        position: 'top-end',
        icon: 'success',
        title: 'Ha sido actualizado correctamente',
        showConfirmButton: false,
        timer: 1500
      })
        getSupplier()
        dialog.value = false
    })

}

</script>