<template>
    <div class="text-center">
      <v-btn
        color="secondary" 
        variant="outlined"
      >
        Agregar Proveedor
  
        <v-dialog
          v-model="dialog"
          activator="parent"
          width="auto"
        >
          <v-card color="#114b86">
            <v-card-title class="text-h5">
              <span style="color: white;">Agregar Proveedor</span>
            </v-card-title>
            <v-sheet max-width="600" >
            <v-form  style="background-color: #114b86fb; color:white" @submit.prevent="onCreate" class="pa-10">
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
                  variant="flat"
                  type="submit"
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
import { ref } from 'vue'
import { rules } from '../../utils/input'

import Swal from 'sweetalert2'
import axios from 'axios';
const dialog = ref(false)


const modelForm = ref({
  business_name: '',
  dni: '',
  contact_person: '',
  contact_mail: '',
  contact_phone: '',
  city: '',
  address: ''
})

function onCreate() {
  axios.post('/agregarProveedor', modelForm.value).then((response) => {
    Swal.fire({
          position: 'top-end',
          icon: 'success',
          title: 'Ha sido agregado correctamente',
          showConfirmButton: false,
          timer: 1500
        })
          window.location.reload();
          dialog.value = false
  })
}

</script>