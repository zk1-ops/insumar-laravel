<template>
  <v-toolbar color="transparent" title="Clientes">
      <v-spacer></v-spacer>

      <AdminDialogAddClient/>
    </v-toolbar> <br>
  <div class="table-responsive">
               <table class="table">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Nombre</th>
                      <th scope="col">Razon Social</th>
                      <th scope="col">Email</th>
                      <th scope="col">Telefono</th>
                      <th scope="col">Acciones</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr v-for="(client, i) in arrayClients" :key="i">
                      <th scope="row">{{ client.id  }}</th>
                      <td>{{ client.first_name  }} {{ client.last_name  }}</td>
                      <td>{{ client.business_name  }}</td>
                      <td>{{ client.email   }}</td>
                      <td>{{ client.phone  }}</td>
                      <td>
                            <v-btn icon="mdi-file" class="m-1" color="primary" size="x-small" @click="openDetails(client)" />
                            <v-btn icon="mdi-pencil" class="ml-1" color="warning"  size="x-small" @click="openDialog(client)" />
                            <v-btn icon="mdi-delete" class="ml-1" color="red" size="x-small"  @click="eliminarCliente(client)" />
                      </td>
                    </tr>
                  </tbody>
                </table>
            </div>

            <v-dialog
                    v-model="details"
                    width="auto"
                >
                <v-card
                  color="#114b86" 
                  class="pa-5"
                >
                  <v-card-title style="color: white;">Nombre del cliente: {{ modelForm.first_name }} {{ modelForm.last_name }}</v-card-title>
                    <v-list
                      :lines="false"
                      density="compact"
                      nav
                      style="background: transparent; color: white;"
                    >
                      <v-list-item
                        color="primary"
                        value="1"
                        :title="`RUT: ${modelForm.dni}`"
                      >
                          <template v-slot:prepend>
                              <v-icon icon="mdi-card-account-details"></v-icon>
                          </template>
                      </v-list-item>

                      <v-list-item
                        color="primary"
                        value="2"
                        :title="`Correo electrónico: ${modelForm.email}`"
                      >
                          <template v-slot:prepend>
                              <v-icon icon="mdi-email"></v-icon>
                          </template>
                      </v-list-item>

                      <v-list-item
                        color="primary"
                        value="3"
                        :title="`Contacto: ${modelForm.phone}`"
                      >
                          <template v-slot:prepend>
                              <v-icon icon="mdi-phone"></v-icon>
                          </template>
                      </v-list-item>

                      <v-list-item
                        color="primary"
                        value="3"
                        :title="`Ciudad: ${modelForm.city}`"
                      >
                          <template v-slot:prepend>
                              <v-icon icon="mdi-city"></v-icon>
                          </template>
                      </v-list-item>

                      <v-list-item
                        color="primary"
                        value="3"
                        :title="`Dirección: ${modelForm.address}`"
                      >
                          <template v-slot:prepend>
                              <v-icon icon="mdi-map-marker"></v-icon>
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
          <v-card-title style="color: white;">Modificando el empleado ({{ modelForm.first_name }} {{ modelForm.last_name }})</v-card-title>
          <v-form style="color: white;" @submit.prevent="updateClient()">
          <v-container>
                <v-row>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="modelForm.first_name"
                            variant="outlined"
                            prepend-inner-icon="mdi-account"
                            label="Nombre"
                            :rules="[rules.required]"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            v-model="modelForm.last_name"
                            variant="outlined"
                            prepend-inner-icon="mdi-account"
                            label="Apellido"
                            :rules="[rules.required]"
                        >
                        </v-text-field>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-select
                            disabled
                            prepend-inner-icon="mdi-google-my-business"
                            variant="outlined"
                            v-model="modelForm.business_name"
                            label="Razon Social"
                            :items="['Persona Juridica', 'Persona Normal']"
                            :rules="[rules.required]"
                        ></v-select>
                    </v-col>
                    <v-col cols="12" md="6">
                        <v-text-field
                            disabled
                            v-model="modelForm.dni"
                            variant="outlined"
                            prepend-inner-icon="mdi-card-account-details"
                            label="RUT"
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
                    <v-col cols="12" md="6">
                  <v-text-field
                    v-model="modelForm.phone"
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
import { onMounted, ref } from 'vue'
import axios from 'axios';
import Swal from 'sweetalert2';
import { rules } from '../../utils/input'

const arrayClients = ref([])

const dialog = ref(false)

const details = ref(false)

function getClients() {
  axios.get('/admin/GetClients').then((response) => {
     arrayClients.value = response.data
  })
}

const modelForm = ref({
   id: null,
   first_name: '',
   last_name: '',
   business_name: '',
   dni: '',
   email: '',
   phone: '',
   city: '',
   address: ''
})

onMounted(() => {
   getClients()
})

function eliminarCliente(data) {

    Swal.fire({
    title: 'Estas seguro?',
    text: "No puedes revertir esto !",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonColor: '#3085d6',
    cancelButtonColor: '#d33',
    cancelButtonText: 'Cancelar',
    confirmButtonText: 'Si, eliminar !'
  }).then((result) => {
    if (result.isConfirmed) {
      axios.post('/eliminarCliente', { id: data.id }).then(function response(){
          Swal.fire(
          'Elimando !',
          'El cliente ha sido eliminado con exito. !',
          'success'
        )

        getClients()
      }).catch(function (error) {
        Swal.fire(
                'Error !',
                'El Cliente no puede ser eliminado ya que tiene facturas registradas.',
                'error'
          )
      })
    }
  })
 
}

function openDialog(data) {
  dialog.value = true

  modelForm.value.id = data.id
  modelForm.value.first_name = data.first_name
  modelForm.value.last_name = data.last_name
  modelForm.value.email = data.email
  modelForm.value.phone = data.phone
  modelForm.value.dni = data.dni
  modelForm.value.city = data.city
  modelForm.value.address = data.address
  modelForm.value.business_name = data.business_name

  
}

function openDetails(data) {
  details.value = true

  modelForm.value.id = data.id
  modelForm.value.first_name = data.first_name
  modelForm.value.last_name = data.last_name
  modelForm.value.email = data.email
  modelForm.value.phone = data.phone
  modelForm.value.dni = data.dni
  modelForm.value.city = data.city
  modelForm.value.address = data.address
  modelForm.value.business_name = data.business_name


}

function updateClient() {
  axios.post('/editarCliente', modelForm.value).then((response) => {
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Cliente actualizado con exito !',
      showConfirmButton: false,
      timer: 1500
    })

    dialog.value = false
    getClients()
  })
}

</script>