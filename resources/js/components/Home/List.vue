<template>
    <v-list-item-group>
      <v-list-item v-for="(item, i) in items" :key="i">
        <v-list-item-content>
          <v-list-item-title><v-icon class="ma-2" :icon="item.icon" color="success"/>{{ item.text }}</v-list-item-title>
        </v-list-item-content>
      </v-list-item>
    </v-list-item-group>
  </template>
  <script>
  export default {
    data: () => ({
      items: [
        { text: 'Variedad de productos congelados de alta calidad.', icon: 'mdi-check-bold' },
        { text: 'Procesos de congelación modernos para mantener la calidad.', icon: 'mdi-check-bold' },
        { text: 'Entrega rápida y precios competitivos.', icon: 'mdi-check-bold' },
        { text: 'Atención personalizada y compromiso con la sostenibilidad.', icon: 'mdi-check-bold' },
      ],
    }),
  }
  </script>