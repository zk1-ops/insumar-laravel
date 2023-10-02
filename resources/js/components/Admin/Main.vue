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
      
   <ul class="navbar-nav align-items-center right-nav-link">    
     <li class="nav-item">
       <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
         <span class="user-profile"><img src="https://static.vecteezy.com/system/resources/previews/019/896/008/original/male-user-avatar-icon-in-flat-design-style-person-signs-illustration-png.png" class="img-circle" alt="user avatar"></span>
       </a>
       <ul class="dropdown-menu dropdown-menu-right">
        <li class="dropdown-item user-details">
         <a href="javaScript:void();">
            <div class="media">
             <div class="media-body">
             <h6 class="mt-2 user-title">{{ userData.first_name }} {{ userData.last_name }}</h6>
             <p class="user-subtitle">{{ userData.email }}</p>
             </div>
            </div>
           </a>
         </li>
       </ul>
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