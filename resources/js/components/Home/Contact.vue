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
      <v-form ref="form" v-model="validForm" class="white">
        <v-row class="ma-2">
          <v-col cols="12">
            <v-text-field id="nombre" name="nombre" v-model="modelForm.name" :counter="32"
              class="text-2" label="Nombre" required>
            </v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field :counter="9" type="number" id="celu" name="celu" v-model="modelForm.celu" class="text-2" 
              label="N° Celular (912345678)" required></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-text-field id="email" name="email" v-model="modelForm.email" class="text-2" 
              label="E-mail" required></v-text-field>
          </v-col>
          <v-col cols="12">
            <v-textarea id="mensaje" name="mensaje" v-model="modelForm.message" class="text-2" :counter="512"
               label="Mensaje" required></v-textarea>
          </v-col>
          <VBtn :loading="loading" name="enviar" :disabled="!validForm" style="left: 45%"
            color="primary">
            enviar
          </VBtn>
        </v-row>
      </v-form>
    </v-row>
  </v-container>
</template>
<script setup lang="ts">
import { ref } from 'vue'
const validForm = ref(true)
const loading = ref(false)
const modelForm = ref({
      name: '',
      email: '',
      celu: '',
      message: ''
})

const mensaje = ref('')
const mostrarMensaje = ref(false)


</script>