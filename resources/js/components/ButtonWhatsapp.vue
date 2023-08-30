<template>
    <div class="floating-button">
      <v-btn fab icon color="#075e54" size="50" dark @click="sendMessage">
        <v-tooltip activator="parent" location="start">Envianos un mensaje</v-tooltip>
        <v-icon size="35" color="white">mdi-whatsapp</v-icon>
      </v-btn>
    </div>
  </template>
  
  <script>
  export default {
    methods: {
      sendMessage() {
        // Aquí puedes agregar la lógica para enviar un mensaje de WhatsApp
        window.open("https://api.whatsapp.com/send/?phone=56949969062&text&type=phone_number&app_absent=0", "_blank");
      }
    }
  }
  </script>
  
  <style>
  .floating-button {
    position: fixed;
    bottom: 20px;
    right: 20px;
    z-index: 9999;
    border-radius: 50%;
    overflow: hidden;
    box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
  }
  </style>
  