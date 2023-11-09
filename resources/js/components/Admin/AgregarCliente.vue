<template>
    <v-row justify="center">
    <v-dialog
      v-model="dialogAddClient"
      persistent
      width="auto"
    >
      <template v-slot:activator="{ props }">
        <v-btn
          v-bind="props"
          color="secondary" variant="outlined"
          >
          Agregar cliente
        </v-btn>
      </template>
      <v-card color="#114b86">      
        <v-card-title style="color: white;">Creando un nuevo cliente</v-card-title>
        <v-form style="color: white;" @submit.prevent="onCreate()">
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
            <v-btn color="red" @click="dialogAddClient = false">Cerrar</v-btn>
            <v-btn variant="tonal" type="submit" color="success">Crear</v-btn>
        </v-card-actions>
        </v-form>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script setup lang="ts">
import axios from 'axios';
import Swal from 'sweetalert2';
import { ref, onMounted } from 'vue'
import { rules } from '../../utils/input'

const dialogAddClient = ref(false)

const modelForm = ref({
   first_name: '',
   last_name: '',
   business_name: '',
   dni: '',
   email: '',
   phone: '',
   city: '',
   address: ''
})

function onCreate() {

  axios.post('/crearCliente', modelForm.value).then((reponse) => {
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Cliente agregado correctamente',
      showConfirmButton: false,
      timer: 1500
    })

    dialogAddClient.value = false
    window.location.reload();
  })
  
}

</script>