<template>
    <v-toolbar color="transparent" title="Empleados">
      <v-spacer></v-spacer>

      <AdminDialogAddEmployees />
    </v-toolbar> <br>

    <div class="table-responsive">
                 <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Correo Electronico</th>
                        <th scope="col">Rol</th>
                        <th scope="col">Fecha de creación</th>      
                        <th scope="col">Acciones</th>
                       </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(emp, i) in arrayEmpleados" :key="i">
                        <th scope="row">{{ emp.id }}</th>
                        <td>{{  emp.first_name  }} {{ emp.last_name  }}</td>
                        <td>{{  emp.email  }}</td>
                        <td>{{  emp.name  }}</td>
                        <td>{{  emp.created_at }}</td>
                        <td>
                          <v-btn :disabled="emp.id == userData.id ? true : false" icon="mdi-pencil" color="warning"  size="x-small" @click="openModal(emp)" />
                          <v-btn :disabled="emp.id == userData.id ? true : false" icon="mdi-delete" class="ml-1" color="red" size="x-small" @click="deleteEmploye(emp.id)" />
                        </td>
                      </tr>
                    </tbody>
                  </table>
    </div>

    <v-dialog
       v-model="dialog"
       width="auto"
     >
     <v-card color="#114b86">
          <v-card-title style="color: white;">Modificando el empleado ({{ modelForm.first_name }} {{ modelForm.last_name }})</v-card-title>
          <v-form style="color: white;" @submit.prevent="updateEmploye()">
          <v-container>
                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="modelForm.first_name"
                            variant="outlined"
                            prepend-inner-icon="mdi-account"
                            label="Nombre empleado"
                            :rules="[rules.required]"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="modelForm.last_name"
                            variant="outlined"
                            prepend-inner-icon="mdi-account"
                            label="Apellido empleado"
                            :rules="[rules.required]"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" md="12">
                        <v-text-field
                            v-model="modelForm.email"
                            variant="outlined"
                            prepend-inner-icon="mdi-email"
                            label="Correo electronico"
                            :rules="[rules.required, rules.email]"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" md="12">
                        <v-text-field
                            v-model="modelForm.password"
                            variant="outlined"
                            prepend-inner-icon="mdi-key-variant"
                            label="Contraseña"
                            type="password"
                            :rules="[rules.required, rules.minLength(8), rules.maxLength(32)]"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12">
                        <v-select
                         v-model="modelForm.idRol"
                        :items="arrayRoles"
                        item-title="name"
                        item-value="id"
                        variant="outlined"
                        label="Rol del empleado"
                        prepend-inner-icon="mdi-security"
                        :rules="[rules.required]"
                        ></v-select>
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
</template>
<script setup lang="ts">
import { ref, onMounted } from 'vue'
import axios from 'axios'
import Swal from 'sweetalert2';
import { rules } from '../../utils/input'

const arrayRoles = ref([])
const arrayEmpleados = ref([])

const modelForm = ref({
   id: null,
   first_name: '',
   last_name: '',
   email: '',
   password: '',
   idRol: null
})


const dialog = ref(false)

const userData = ref({})

function getEmployee() {
  axios.get('/admin/getEmployees')
          .then((response) => {
            arrayEmpleados.value = response.data 
    })
}

onMounted( () => {
  getEmployee()

  axios.get('/admin/Role').then((response) => {
      arrayRoles.value = response.data
  })   

  axios.get('/admin/GetUser')
          .then((response) => {
            userData.value = response.data                               
   })
})


function deleteEmploye(id) {


      Swal.fire({
      title: 'Estas seguro de eliminar este empleado?',
      text: "No puedes revertir esto!",
      icon: 'warning',
      showCancelButton: true,
      confirmButtonColor: '#3085d6',
      cancelButtonColor: '#d33',
      confirmButtonText: 'Si, eliminar'
    }).then((result) => {
      if (result.isConfirmed) {
        axios.post('/eliminarEmpleado', { id })
        .then((response) => {
            Swal.fire(
            'Eliminado!',
            'Has eliminado correctamente al empleado',
            'success'
          )

          getEmployee()
        }).catch(function (error) {
              Swal.fire(
                'Error !',
                'El empleado no pudo ser eliminado ya que tiene ventas asociadas a la cuenta.',
                'error'
              )
            })
      }
    })
}

function openModal(data) {
  dialog.value = true

  modelForm.value.id = data.id
  modelForm.value.first_name = data.first_name
  modelForm.value.last_name = data.last_name
  modelForm.value.email = data.email
  modelForm.value.idRol = data.idRol
  
}

function updateEmploye() {
  axios.post('/actualizarEmpleado', modelForm.value).then((response) => {
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Empleado actualizado con exito !',
      showConfirmButton: false,
      timer: 1500
    })

    dialog.value = false
    getEmployee()
  })
}

</script>