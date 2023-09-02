<template>
    <v-row justify="center">
    <v-dialog
      v-model="dialogAddProd"
      persistent
      width="auto"
    >
      <template v-slot:activator="{ props }">
        <v-btn
          v-bind="props"
          color="secondary" variant="outlined"
          >
          Agregar productos
        </v-btn>
      </template>
      <v-card>
        <v-card-title class="text-h5">
          Use Google's location service?
        </v-card-title>
        <v-card-text>Let Google help apps determine location. This means sending anonymous location data to Google, even when no apps are running.</v-card-text>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn
            color="green-darken-1"
            variant="text"
            @click="dialogAddProd = false"
          >
            Disagree
          </v-btn>
          <v-btn
            color="green-darken-1"
            variant="text"
            @click="dialogAddProd = false"
          >
            Agree
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
  </v-row>
</template>
<script setup lang="ts">
import { ref } from 'vue'

const dialogAddProd = ref(false)

</script>