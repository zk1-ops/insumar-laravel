<template>

<v-snackbar
      v-model="mostrarMensaje"
      multi-line
   >
   {{ mensaje }}

      <template v-slot:actions>
        <VBtn
          color="red"
          variant="text"
          @click="mostrarMensaje = false"
        >
          Cerrar
        </VBtn>
      </template>
  </v-snackbar>
  <v-container>
    <v-row align="center" justify="center">
      <v-form ref="form" v-model="validForm" class="white" @submit.prevent="enviarForm">
        <v-row class="ma-2">
          <v-col cols="12">
            <v-text-field :rules="[ rules.required ]" id="nombre" name="nombre" v-model="modelForm.name" :counter="32"
              class="text-2" label="Nombre" required>
            </v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field :rules="[ rules.required, rules.isNumber, rules.minLength(8), rules.maxLength(9) ]" :counter="9" id="celu" name="celu" v-model="modelForm.phone" class="text-2" 
              label="N° Celular (912345678)" required></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field :rules="[ rules.required ]" id="email" name="email" v-model="modelForm.mail" class="text-2" 
              label="E-mail" required></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-textarea :rules="[ rules.required, rules.maxLength(512) ]" maxLength="512" id="mensaje" name="mensaje" v-model="modelForm.message" class="text-2" :counter="512"
               label="Mensaje" required></v-textarea>
          </v-col>
          <v-btn :loading="loading" type="submit" style="left: 45%"
            color="primary">
            enviar
          </v-btn>
        </v-row>
      </v-form>
    </v-row>
  </v-container>
</template>
<script setup lang="ts">
import { ref } from 'vue'
import axios from 'axios';
import Swal from 'sweetalert2';
import { rules } from '../../utils/input';

const validForm = ref(true)
const loading = ref(false)
const modelForm = ref({
      name: '',
      mail: '',
      phone: '',
      message: ''
})

const mensaje = ref('')
const mostrarMensaje = ref(false)

function enviarForm() {

  if(!modelForm.value.name || !modelForm.value.mail || !modelForm.value.phone || !modelForm.value.message) { return true; }

  loading.value = true

  axios.post('/enviarForm', modelForm.value)
  .then((response) => {
      Swal.fire({
        title: "Enviado!",
        text: "Nos contactaremos a la brevedad.",
        icon: "success"
      });
      
      loading.value = false
      window.location.reload()
  }).catch((error) => {
    console.log(error);
    
  })

}


</script>