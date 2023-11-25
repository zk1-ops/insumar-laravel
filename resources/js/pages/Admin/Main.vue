<template>
  
    <!-- Start wrapper-->
  <div id="wrapper">
   
    <!-- Sidebar -->
    <AdminSidebar/>
 <!--Start topbar header-->
 <header class="topbar-nav">
  <nav class="navbar navbar-expand fixed-top">
   <ul class="navbar-nav mr-auto align-items-center">
     <li class="nav-item">
       <a class="nav-link toggle-menu" href="javascript:void();">
        <i class="icon-menu menu-icon"></i>
      </a>
     </li>
   </ul>

   <v-space></v-space>

   <v-menu
      v-model="menu"
      :close-on-content-click="false"
      location="end"
    >
      <template v-if="isNotNull" v-slot:activator="{ props }">
        <v-btn
          color="yellow"
          variant="text"
          v-bind="props"
        >
            <v-badge v-if="dataEmailFilter.length > 0" :content="dataEmailFilter.length" color="error">
              <v-icon>mdi-bell</v-icon>
            </v-badge>
          
            <v-icon v-else>mdi-bell</v-icon>
          </v-btn>
      </template>

      <template v-else v-slot:activator="">
        <v-btn
          color="yellow"
          variant="text"
        >
          
            <v-icon >mdi-bell-outline</v-icon>
        </v-btn>
      </template>

        
          <v-card min-width="300">
            <v-list v-for="(mail, i) in dataEmail" :key="i">
              <v-list-item
                prepend-avatar="https://cdn.vuetifyjs.com/images/john.jpg"
              >
              <v-list-item-content>
                <v-list-item-title>
                  {{ mail.content.name }}
                </v-list-item-title>
                <v-list-item-subtitle>
                  {{ mail.content.email_contact }}
                </v-list-item-subtitle>
                <v-list-item-subtitle>
                   {{moment(mail.sent_at).format('LL')}}
                </v-list-item-subtitle>
              </v-list-item-content>
              <template v-slot:append>
                <v-tooltip bottom>
                  <template v-slot:activator="{ on }">
                    <v-btn
                      v-if="mail.reviewed === false"
                      v-on="on"
                      variant="text"
                      icon="mdi-eye"
                      color="blue"
                      title="Ver correo"
                      @click="mensajeDialog(mail)"
                    ></v-btn>
                    <v-btn
                      v-else
                      v-on="on"
                      variant="text"
                      icon="mdi-check"
                      color="green"
                      title="Ver correo"
                      @click="mensajeDialog(mail)"
                    ></v-btn>
                  </template>
                  <span>Ver correo</span>
                </v-tooltip>
              </template>
              </v-list-item>
            </v-list>

            <v-divider></v-divider>
          </v-card>
      </v-menu>

      <v-dialog
        v-model="dialog"
        width="auto"
      >
        <v-card>
          <v-card-title>Asunto: {{ mailVariable.subject  }}</v-card-title>
          <v-card-text>
            Estas viendo el mensaje de: <br> <strong>{{ mailVariable.name  }}</strong>
          </v-card-text>
          <v-card-text>
            Numero de telefono: <strong> {{  mailVariable.phone  }}</strong>
          </v-card-text>
          <v-card-text>
            Correo electronico: <strong>{{  mailVariable.mail  }}</strong>
          </v-card-text>
          <v-card-text>
            Mensaje:
             <strong>{{  mailVariable.message  }}</strong>
          </v-card-text>
          <v-card-actions>
            <v-btn v-if="mailVariable.reviewed === false" color="primary" block @click="updateView(mailVariable.id)">Marcar como leido</v-btn>
            <v-btn v-else color="red" block @click="eliminar(mailVariable.id)">Eliminar</v-btn>

          </v-card-actions>
        </v-card>
    </v-dialog>

 </nav>
 </header>

 <!--End topbar header-->
 
 <div class="clearfix"></div>
 
     
   <div class="content-wrapper">
     <div class="container-fluid">
        
        <router-view></router-view> 
       <!--End Content-->
       
     <!--start overlay-->
           <div class="overlay toggle-menu"></div>
         <!--end overlay-->
         
     </div>
     <!-- End container-fluid-->
     
     </div><!--End content-wrapper-->
    <!--Start Back To Top Button-->
     <a href="javaScript:void();" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
     <!--End Back To Top Button-->
    
   </div><!--End wrapper-->
   
 </template>


<script setup lang="ts">
import axios from 'axios';
import { ref, onMounted, watch } from 'vue'
import moment from 'moment';
import 'moment/locale/es';
import Swal from 'sweetalert2'

const userData = ref({})
const dataEmail = ref([])

const dataEmailFilter = ref([])

const isNotNull = ref(false)

const dialog = ref(false)
const menu = ref(false)

const mailVariable = ref({
   id: null,
   name: '',
   mail: '',
   phone: '',
   message: '',
   subject: '',
   reviewed: false
})

function getEmails() {
  axios.get('/email/GetMail')
          .then((response) => {
            
            dataEmail.value = response.data        
                    

            dataEmailFilter.value = dataEmail.value.filter(mail => mail.reviewed === false);  
            
            

             if ( dataEmail.value == 0 ) {

                isNotNull.value = false
                
             }else if (dataEmail.value) {
                isNotNull.value = true
                
             }
             
                          
          })
}

onMounted(() => {
  moment.updateLocale('es', { invalidDate: 'No aplica' })

  axios.get('/admin/GetUser')
          .then((response) => {
            userData.value = response.data                               
   })

   getEmails()
   
}) 


function mensajeDialog(mail) {
  dialog.value = true
  mailVariable.value.id = mail.id
  mailVariable.value.name = mail.content.name
  mailVariable.value.mail = mail.content.email_contact
  mailVariable.value.phone = mail.content.phone
  mailVariable.value.message = mail.content.message
  mailVariable.value.subject = mail.subject
  mailVariable.value.reviewed = mail.reviewed
}

function updateView(id) {
    axios.post('/mail/updateStatus', { idmensaje : id})
            .then((response) => {
                  menu.value = false
              if (response) {
                Swal.fire({
                  position: "top-end",
                  icon: "success",
                  title: "Has marcado este mensaje como LEIDO !",
                  showConfirmButton: false,
                  timer: 1500
                });

                dialog.value = false
                getEmails()
              }
            })
}

function eliminar(id) {
    axios.post('/mail/deleteMail', { idmensaje : id})
      .then((response) => {
      
            menu.value = false
              if (response) {
                Swal.fire({
                  position: "top-end",
                  icon: "success",
                  title: "Has eliminado este mensaje!",
                  showConfirmButton: false,
                  timer: 1500
                });

                dialog.value = false
                getEmails()
              }
            })
}
</script>