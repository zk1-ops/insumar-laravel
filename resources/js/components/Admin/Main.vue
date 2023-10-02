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
import { ref, onMounted } from 'vue'


const userData = ref({})

onMounted(() => {
  axios.get('/admin/GetUser')
          .then((response) => {
            userData.value = response.data                               
   })
}) 
</script>