<template>
    <v-row justify="center">
    <v-dialog
      v-model="dialogAddEmp"
      persistent
      width="auto"
    >
      <template v-slot:activator="{ props }">
        <v-btn
          v-bind="props"
          color="secondary" variant="outlined"
          >
          Agregar empleado
        </v-btn>
      </template>
      <v-card color="#114b86">      
        <v-card-title style="color: white;">Creando un nuevo empleado</v-card-title>
        <v-form style="color: white;" @submit.prevent="onCreate()">
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
            <v-btn color="red" @click="dialogAddEmp = false">Cerrar</v-btn>
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


const dialogAddEmp = ref(false)

const arrayRoles = ref([])

const modelForm = ref({
   first_name: '',
   last_name: '',
   email: '',
   password: '',
   idRol: null
})

onMounted(() => {
  axios.get('/admin/Role').then((response) => {
      arrayRoles.value = response.data
  })   

})

function onCreate() {
  if (!modelForm.value.first_name || 
  !modelForm.value.last_name ||
  !modelForm.value.email ||
  !modelForm.value.password ||
  !modelForm.value.idRol) 
  { return false}

  axios.post('/crearEmpleado', modelForm.value).then((reponse) => {
    Swal.fire({
      position: 'top-end',
      icon: 'success',
      title: 'Empleado agregado correctamente',
      showConfirmButton: false,
      timer: 1500
    })

    dialogAddEmp.value = false
     window.location.reload();
  })
    
}

</script>